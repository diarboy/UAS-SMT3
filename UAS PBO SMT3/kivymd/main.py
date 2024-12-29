from kivymd.app import MDApp
from kivymd.uix.screen import MDScreen
from kivymd.uix.screenmanager import MDScreenManager
from kivymd.uix.dialog import MDDialog
from kivymd.uix.button import MDFlatButton
from kivy.properties import ObjectProperty
from kivy.uix.filechooser import FileChooserIconView
from kivymd.uix.menu import MDDropdownMenu
from kivymd.uix.button import MDRaisedButton
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
class RegisterScreen(MDScreen):
    def register_user(self):
        username = self.ids.username.text
        email = self.ids.email.text
        password = self.ids.password.text
        confirm_password = self.ids.confirm_password.text

        if not username or not email or not password or not confirm_password:
            self.show_dialog("Error", "All fields are required!")
            return

        if password != confirm_password:
            self.show_dialog("Error", "Passwords do not match!")
            return

        if len(password) < 8:
            self.show_dialog("Error", "Password must be at least 8 characters long!")
            return

        conn = get_db_connection()
        cursor = conn.cursor()

        # Check if username exists
        cursor.execute("SELECT * FROM tbl_member WHERE username = %s", (username,))
        if cursor.fetchone():
            self.show_dialog("Error", "Username already exists!")
            conn.close()
            return

        # Hash password and save to database
        hashed_password = bcrypt.hashpw(password.encode('utf-8'), bcrypt.gensalt())
        try:
            cursor.execute("INSERT INTO tbl_member (username, password, email) VALUES (%s, %s, %s)", 
                           (username, hashed_password, email))
            conn.commit()
            self.show_dialog("Success", "Registration successful!")
            self.manager.current = "login"
        except mysql.connector.Error as err:
            self.show_dialog("Error", f"Database error: {err}")
        finally:
            conn.close()
            
    def reset_fields(self):
        self.ids.username.text = ""
        self.ids.email.text = ""
        self.ids.password.text = ""
        self.ids.confirm_password.text = ""

    def show_dialog(self, title, message):
        dialog = MDDialog(
            title=title,
            text=message,
            buttons=[
                MDFlatButton(
                    text="Close",
                    on_release=lambda x: dialog.dismiss()
                ),
            ],
        )
        dialog.open()

# Login Screen
class LoginScreen(MDScreen):
    def login_user(self):
        username = self.ids.username.text
        password = self.ids.password.text

        if not username or not password:
            self.show_dialog("Error", "Username and password are required!")
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
            self.show_dialog("Error", "Invalid username or password!")
    
    def reset_fields(self):
        self.ids.username.text = ""
        self.ids.password.text = ""

    def show_dialog(self, title, message):
        dialog = MDDialog(
            title=title,
            text=message,
            buttons=[
                MDFlatButton(
                    text="Close",
                    on_release=lambda x: dialog.dismiss()
                ),
            ],
        )
        dialog.open()


# Formulir Screen
class FormulirScreen(MDScreen):
    selected_file_1 = ObjectProperty(None)
    selected_file_2 = ObjectProperty(None)
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

    def upload_file_1(self):
        filechooser = FileChooserIconView(filters=["*.pdf"])  # Hanya file PDF yang dipilih
        filechooser.bind(on_selection=lambda instance, value: self.on_file_selected(value, 1))
        popup = MDDialog(title="Pilih File PDF", type="custom", content_cls=filechooser)
        popup.open()

    def upload_file_2(self):
        filechooser = FileChooserIconView(filters=["*.pdf"])  # Hanya file PDF yang dipilih
        filechooser.bind(on_selection=lambda instance, value: self.on_file_selected(value, 2))
        popup = MDDialog(title="Pilih File PDF", type="custom", content_cls=filechooser)
        popup.open()

    def on_file_selected(self, selection, file_number):
        if selection:
            selected_file = selection[0]
            if file_number == 1:
                self.selected_file_1 = selected_file
                self.ids.file1.text = f"File 1: {selected_file}"
            elif file_number == 2:
                self.selected_file_2 = selected_file
                self.ids.file2.text = f"File 2: {selected_file}"
        else:
            if file_number == 1:
                self.ids.file1.text = "Pilih File"
            elif file_number == 2:
                self.ids.file2.text = "Pilih File"

    def preview_data(self):
        data = {
            "Jenis Permohonan": self.ids.permohonan.text,
            "Produk Layanan": self.ids.layanan.text,
            "Nama": self.ids.nama.text,
            "N.I.K": self.ids.nik.text,
            "No HP": self.ids.no_hp.text,
            "Email": self.ids.email.text,
            "File 1": self.selected_file_1,
            "File 2": self.selected_file_2,
        }
        preview_content = "\n".join([f"{key}: {value}" for key, value in data.items()])
        popup = MDDialog(
            title="Pratinjau Data",
            text=preview_content,
            size_hint=(0.8, 0.8),
        )
        popup.open()

    def submit_data(self):
        data = {
            "nama": self.ids.nama.text,
            "nik": self.ids.nik.text,
            "email": self.ids.email.text,
            "no_hp": self.ids.no_hp.text,
            "permohonan": self.ids.permohonan.text,
            "layanan": self.ids.layanan.text,
            "file1": self.selected_file_1 if self.selected_file_1 else "",
            "file2": self.selected_file_2 if self.selected_file_2 else ""
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
                # f"{data['file1']}, {data['file2']}"
            ))
            conn.commit()
            self.show_dialog("Success", "Data berhasil dikirim!")
        except mysql.connector.Error as err:
            self.show_dialog("Error", f"Database error: {err}")
        finally:
            conn.close()

    def show_dialog(self, title, message):
        dialog = MDDialog(
            title=title,
            text=message,
            buttons=[
                MDFlatButton(
                    text="Close",
                    on_release=lambda x: dialog.dismiss()
                ),
            ],
        )
        dialog.open()


# Main App
class SempanerApp(MDApp):
    def build(self):
        sm = MDScreenManager()
        sm.add_widget(LoginScreen(name="login"))
        sm.add_widget(RegisterScreen(name="register"))
        sm.add_widget(FormulirScreen(name="form"))
        return sm

if __name__ == "__main__":
    SempanerApp().run()