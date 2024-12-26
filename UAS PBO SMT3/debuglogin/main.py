from kivy.app import App
from kivy.uix.screenmanager import ScreenManager, Screen
from kivy.uix.popup import Popup
from kivy.uix.label import Label
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
    pass

# Main App
class MyApp(App):
    def build(self):
        sm = ScreenManager()
        sm.add_widget(LoginScreen(name="login"))
        sm.add_widget(RegisterScreen(name="register"))
        sm.add_widget(FormulirScreen(name="form"))
        return sm

if __name__ == "__main__":
    MyApp().run()


# class FormScreen(Screen):
#     selected_file_1 = ObjectProperty(None)
#     selected_file_2 = ObjectProperty(None)

#     def update_layanan(self, permohonan):
#         layanan_map = {
#             "Legalitas Perusahaan": [
#                 "Pendirian PT", "Pendirian CV", "Pendirian Firma", 
#                 "Pendirian Yayasan", "Pendirian Koperasi", "Pendirian Perkumpulan"
#             ],
#             "Jasa NIB & OSS": [
#                 "Pendaftaran Akun OSS dan NIB Perorangan", 
#                 "Pendaftaran Akun OSS dan NIB Perusahaan", 
#                 "Pengurusan Sertifikat Standar", "Pengurusan Persetujuan Lingkungan", 
#                 "Pengurusan Perizinan UMKU"
#             ],
#             "Merek dan Hak Cipta": [
#                 "Analisa Merek", "Pendaftaran Merek untuk 1 Kelas", 
#                 "Pendaftaran Hak Cipta", "Pendaftaran Paten", 
#                 "Pengurusan Madrid Office of Origin"
#             ],
#             "Perpajakan": [
#                 "Pelaporan SPT Tahunan", "Pengukuhan PKP", 
#                 "Penerbitan Sertifikat Elektronik"
#             ],
#         }
#         layanan = layanan_map.get(permohonan, [])
#         self.ids.layanan.values = layanan
#         self.ids.layanan.text = layanan[0] if layanan else ""

#     def on_file_selected(self, selection):
#         if selection:
#             self.selected_file = selection[0]  # Ambil file pertama yang dipilih
#             self.ids.file_label.text = f"File dipilih: {self.selected_file}"
#         else:
#             self.ids.file_label.text = "File belum dipilih."

#     def confirm_file(self):
#         if self.selected_file:
#             try:
#                 import os
#                 file_size = os.path.getsize(self.selected_file)
#                 if file_size > 10 * 1024 * 1024:  # 10 MB
#                     raise Exception("File terlalu besar. Maksimal 10MB.")
                
#                 popup = Popup(
#                     title="Sukses",
#                     content=Label(text="File berhasil dipilih!"),
#                     size_hint=(0.8, 0.4),
#                 )
#                 popup.open()
#             except Exception as e:
#                 popup = Popup(
#                     title="Error",
#                     content=Label(text=str(e)),
#                     size_hint=(0.8, 0.4),
#                 )
#                 popup.open()
#         else:
#             popup = Popup(
#                 title="Error",
#                 content=Label(text="Belum ada file yang dipilih."),
#                 size_hint=(0.8, 0.4),
#             )
#             popup.open()

#     def preview_data(self):
#         data = {
#             "Jenis Permohonan": self.ids.permohonan.text,
#             "Produk Layanan": self.ids.layanan.text,
#             "Nama": self.ids.nama.text,
#             "Email": self.ids.email.text,
#             "No HP": self.ids.no_hp.text,
#             "Dokumen": "dokumen title.pdf",
#             # "Timestamps": str(self.ids.create_at.text)
#         }
#         preview_content = "\n".join([f"{key}: {value}" for key, value in data.items()])
#         popup = Popup(
#             title="Pratinjau Data",
#             content=Label(text=preview_content),
#             size_hint=(0.8, 0.8),
#         )
#         popup.open()

#     def submit_data(self):
#         try:
#             connection = mysql.connector.connect(
#                 host='localhost',
#                 database='contact_form',
#                 user='root',
#                 password=''
#             )
#             cursor = connection.cursor()
#             cursor.execute("INSERT INTO form_kivy (jenis_permohonan, produk_layanan, nama_pemohon, email, no_hp, file_dokumen) VALUES (%s, %s, %s, %s, %s, %s)", 
#                            (self.ids.permohonan.text, self.ids.layanan.text, self.ids.nama.text, self.ids.email.text, self.ids.no_hp.text, "dokumen title.pdf"))
#             connection.commit()
#             self.show_popup("Info", "Data berhasil dikirim!")
#         except mysql.connector.Error as err:
#             self.show_popup("Error", "Database error: {}".format(err))
#         finally:
#             cursor.close()
#             connection.close()

#     def show_popup(self, title, message):
#         popup = Popup(title=title, content=Label(text=message), size_hint=(0.8, 0.4))
#         popup.open()

# class MyApp(App):
#     def build(self):
#         sm = ScreenManager()
#         sm.add_widget(LoginScreen(name='login_screen'))
#         sm.add_widget(RegisterScreen(name='register_screen'))
#         sm.add_widget(FormScreen(name='form_screen'))
#         return sm

# if __name__ == '__main__':
#     MyApp().run()