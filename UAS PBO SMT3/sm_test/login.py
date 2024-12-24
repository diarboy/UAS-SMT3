from kivy.uix.boxlayout import BoxLayout
from kivy.uix.popup import Popup
from kivy.uix.label import Label
from kivy.uix.textinput import TextInput
from kivy.uix.button import Button
from kivy.uix.spinner import Spinner
from kivy.properties import ObjectProperty
from db import DBConnection

class LoginScreen(BoxLayout):
    def login(self):
        username = self.ids.username.text
        password = self.ids.password.text

        db = DBConnection()
        if db.validate_login(username, password):
            App.get_running_app().switch_to_form()
        else:
            popup = Popup(
                title="Login Error",
                content=Label(text="Username atau Password salah!"),
                size_hint=(0.8, 0.4),
            )
            popup.open()

    def register(self):
        App.get_running_app().root_widget.clear_widgets()
        App.get_running_app().root_widget.add_widget(RegisterScreen())

class RegisterScreen(BoxLayout):
    username = ObjectProperty(None)
    password = ObjectProperty(None)
    email = ObjectProperty(None)

    def register_user(self):
        username = self.username.text
        password = self.password.text
        email = self.email.text

        # Validasi password: minimal huruf besar, angka, dan simbol
        if not self.validate_password(password):
            popup = Popup(
                title="Invalid Password",
                content=Label(text="Password harus mengandung huruf besar, angka, dan simbol."),
                size_hint=(0.8, 0.4),
            )
            popup.open()
            return

        db = DBConnection()

        # Periksa apakah username atau email sudah ada
        if db.check_user_exists(username, email):
            popup = Popup(
                title="Registration Error",
                content=Label(text="Username atau Email sudah terdaftar!"),
                size_hint=(0.8, 0.4),
            )
            popup.open()
        else:
            # Masukkan data ke database
            db.insert_user(username, password, email)
            popup = Popup(
                title="Success",
                content=Label(text="Pendaftaran berhasil!"),
                size_hint=(0.8, 0.4),
            )
            popup.open()
            self.clear_inputs()

    def validate_password(self, password):
        # Password harus mengandung huruf besar, angka, dan simbol
        if (any(char.isdigit() for char in password) and
            any(char.isupper() for char in password) and
            any(char in '!@#$%^&*()_+-=' for char in password)):
            return True
        return False

    def clear_inputs(self):
        self.username.text = ''
        self.password.text = ''
        self.email.text = ''
