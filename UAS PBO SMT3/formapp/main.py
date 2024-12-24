from kivy.app import App
from kivy.uix.boxlayout import BoxLayout
from kivy.uix.popup import Popup
from kivy.uix.label import Label
from kivy.uix.filechooser import FileChooserIconView
from kivy.uix.button import Button
from kivy.uix.textinput import TextInput
from kivy.uix.spinner import Spinner
from kivy.uix.scrollview import ScrollView
from kivy.properties import ObjectProperty
from kivy.core.window import Window

class LoginScreen(BoxLayout):
    def login(self):
        username = self.ids.username.text
        password = self.ids.password.text
        
        # Validasi Login
        if username == "admin" and password == "admin":  # Contoh sederhana
            App.get_running_app().switch_to_form()
        else:
            popup = Popup(
                title="Login Error",
                content=Label(text="Username atau Password salah!"),
                size_hint=(0.8, 0.4),
            )
            popup.open()

    def register(self):
        popup = Popup(
            title="Info",
            content=Label(text="Fitur register belum aktif."),
            size_hint=(0.8, 0.4),
        )
        popup.open()


class FormulirScreen(BoxLayout):
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
        popup = Popup(title="Pilih File PDF", content=filechooser, size_hint=(0.8, 0.8))
        popup.open()

    def upload_file_2(self):
        filechooser = FileChooserIconView(filters=["*.pdf"])  # Hanya file PDF yang dipilih
        filechooser.bind(on_selection=lambda instance, value: self.on_file_selected(value, 2))
        popup = Popup(title="Pilih File PDF", content=filechooser, size_hint=(0.8, 0.8))
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
            "Email": self.ids.email.text,
            "No HP": self.ids.no_hp.text,
            "File 1": self.selected_file_1,
            "File 2": self.selected_file_2,
        }
        preview_content = "\n".join([f"{key}: {value}" for key, value in data.items()])
        popup = Popup(
            title="Pratinjau Data",
            content=Label(text=preview_content),
            size_hint=(0.8, 0.8),
        )
        popup.open()

    def submit_data(self):
        # Logika pengiriman data
        popup = Popup(
            title="Info",
            content=Label(text="Data berhasil dikirim!"),
            size_hint=(0.8, 0.4),
        )
        popup.open()


class form(App):
    def build(self):
        self.root_widget = LoginScreen()
        return self.root_widget

    def switch_to_form(self):
        self.root_widget.clear_widgets()
        self.root_widget.add_widget(FormulirScreen())


if __name__ == "__main__":
    form().run()
