from kivy.app import App
from kivy.uix.screenmanager import ScreenManager, Screen
from kivy.uix.popup import Popup
from kivy.uix.label import Label
from kivy.properties import ObjectProperty, StringProperty
from kivy.uix.filechooser import FileChooserIconView
from kivy.uix.boxlayout import BoxLayout
from kivy.uix.button import Button
from os.path import basename
import bcrypt
import mysql.connector

# Database Connection
def get_db_connection():
    return mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="contact_form"
    )

# Registration Screen
class RegisterScreen(Screen):
    def register_user(self):
        username = self.ids.username.text
        email = self.ids.email.text
        password = self.ids.password.text
        confirm_password = self.ids.confirm_password.text

        if not username or not email or not password or not confirm_password:
            self.show_popup("Error", "All fields are required!")
            return

        if password != confirm_password:
            self.show_popup("Error", "Passwords do not match!")
            return

        if len(password) < 8:
            self.show_popup("Error", "Password must be at least 8 characters long!")
            return

        conn = get_db_connection()
        cursor = conn.cursor()

        # Check if username exists
        cursor.execute("SELECT * FROM tbl_member WHERE username = %s", (username,))
        if cursor.fetchone():
            self.show_popup("Error", "Username already exists!")
            conn.close()
            return

        # Hash password and save to database
        hashed_password = bcrypt.hashpw(password.encode('utf-8'), bcrypt.gensalt())
        try:
            cursor.execute("INSERT INTO tbl_member (username, password, email) VALUES (%s, %s, %s)", 
                           (username, hashed_password, email))
            conn.commit()
            self.show_popup("Success", "Registration successful!")
            self.manager.current = "login"
        except mysql.connector.Error as err:
            self.show_popup("Error", f"Database error: {err}")
        finally:
            conn.close()
            
    def reset_fields(self):
        self.ids.username.text = ""
        self.ids.email.text = ""
        self.ids.password.text = ""
        self.ids.confirm_password.text = ""

    def show_popup(self, title, message):
        popup = Popup(title=title, content=Label(text=message), size_hint=(0.8, 0.4))
        popup.open()

# Login Screen
class LoginScreen(Screen):
    def login_user(self):
        username = self.ids.username.text
        password = self.ids.password.text

        if not username or not password:
            self.show_popup("Error", "Username and password are required!")
            return

        conn = get_db_connection()
        cursor = conn.cursor()

        # Check username and password
        cursor.execute("SELECT password FROM tbl_member WHERE username = %s", (username,))
        result = cursor.fetchone()
        conn.close()

        if result and bcrypt.checkpw(password.encode('utf-8'), result[0].encode('utf-8')):
            self.manager.current = "form"
            
        else:
            self.show_popup("Error", "Invalid username or password!")
    
    def reset_fields(self):
        self.ids.username.text = ""
        self.ids.password.text = ""

    def show_popup(self, title, message):
        popup = Popup(title=title, content=Label(text=message), size_hint=(0.8, 0.4))
        popup.open()

# Formulir Screen
class FormulirScreen(Screen):
    nama = ObjectProperty(None)
    nik = ObjectProperty(None)
    email = ObjectProperty(None)
    hp = ObjectProperty(None)
    
    def validasi_formulir(self):
        if (self.nama.text and self.nik.text and 
            self.email.text and self.hp.text):
            self.manager.current = 'upload'
        else:
            popup = Popup(title='Error',
                         content=Label(text='Semua Kolom Wajib Diisi!'),
                         size_hint=(None, None), size=(400, 200))
            popup.open()

    def update_layanan(self, permohonan):
        layanan_map = {
            "Legalitas Perusahaan": [
                "Pendirian PT", "Pendirian CV", "Pendirian Firma", 
                "Pendirian Yayasan", "Pendirian Koperasi", "Pendirian Perkumpulan"
            ],
            "Jasa NIB & OSS": [
                "Pendaftaran Akun OSS dan NIB Perorangan", 
                "Pendaftaran Akun OSS dan NIB Perusahaan", 
                "Pengurusan Sertifikat Standar", "Pengurusan Persetujuan Lingkungan", 
                "Pengurusan Perizinan UMKU"
            ],
            "Merek dan Hak Cipta": [
                "Analisa Merek", "Pendaftaran Merek untuk 1 Kelas", 
                "Pendaftaran Hak Cipta", "Pendaftaran Paten", 
                "Pengurusan Madrid Office of Origin"
            ],
            "Perpajakan": [
                "Pelaporan SPT Tahunan", "Pengukuhan PKP", 
                "Penerbitan Sertifikat Elektronik"
            ],
        }
        layanan = layanan_map.get(permohonan, [])
        self.ids.layanan.values = layanan
        self.ids.layanan.text = layanan[0] if layanan else ""

class UploadScreen(Screen):
    selected_file = StringProperty('')

    def select_file(self, selection):
        if selection:
            self.selected_file = selection[0]
            self.ids.file_label.text = f"Selected File: {basename(selection[0])}"

    def preview_data(self):
        if not self.selected_file:
            self.show_popup("Error", "Please select a file first!")
            return
        FormulirScreen = self.manager.get_screen('form')
        content = BoxLayout(orientation='vertical', padding=10, spacing=10)
        preview_text = (
            f"Nama: {FormulirScreen.nama.text}\n"
            f"NIK: {FormulirScreen.nik.text}\n"
            f"Email: {FormulirScreen.email.text}\n"
            f"No HP: {FormulirScreen.hp.text}\n"
            f"Jenis Permohonan: {FormulirScreen.ids.permohonan.text}\n"
            f"Jenis Layanan: {FormulirScreen.ids.layanan.text}\n"
            f"Lampiran Dokumen: {basename(self.selected_file)}\n"
        )

        content.add_widget(Label(text=preview_text))
        button = Button(text='Close', size_hint=(1, 0.2))
        content.add_widget(button)
        
        popup = Popup(title='Preview Data',
                     content=content,
                     size_hint=(None, None),
                     size=(500, 400))
        
        button.bind(on_press=popup.dismiss)
        popup.open()


    def submit_data(self):
        if not self.selected_file:
            self.show_popup("Error", "Please select a file first!")
            return
        FormulirScreen = self.manager.get_screen('form')
        preview_text = {
            "nama": self.ids.nama.text,
            "nik": self.ids.nik.text,
            "email": self.ids.email.text,
            "no_hp": self.ids.no_hp.text,
            "permohonan": self.ids.permohonan.text,
            "layanan": self.ids.layanan.text
        }

        try:
            conn = get_db_connection()
            cursor = conn.cursor()
            cursor.execute("""
                INSERT INTO form_kivy 
                (nama_pemohon, nik, email, no_hp, jenis_permohonan, produk_layanan) 
                VALUES (%s, %s, %s, %s, %s, %s)
            """, (
                data["nama"], data["nik"], data["email"], 
                data["no_hp"], data["permohonan"], data["layanan"]
                # f"{data['file1']}, {data['file2']}" //file blm msk db
            ))
            conn.commit()
            self.show_popup("Success", "Data berhasil dikirim!")
        except mysql.connector.Error as err:
            self.show_popup("Error", f"Database error: {err}")
        finally:
            conn.close()

    def show_popup(self, title, message):
        popup = Popup(title=title, content=Label(text=message), size_hint=(0.8, 0.4))
        popup.open()


# Main App
class sempaner(App):
    def build(self):
        sm = ScreenManager()
        # sm.add_widget(LoginScreen(name="login"))
        # sm.add_widget(RegisterScreen(name="register"))
        sm.add_widget(FormulirScreen(name="form"))
        sm.add_widget(UploadScreen(name="upload"))
        return sm

if __name__ == "__main__":
    sempaner().run()