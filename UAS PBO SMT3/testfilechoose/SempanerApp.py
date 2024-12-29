from kivy.app import App
from kivy.uix.screenmanager import ScreenManager, Screen
from kivy.properties import ObjectProperty, StringProperty
from kivy.uix.popup import Popup
from kivy.uix.label import Label
from kivy.uix.button import Button
from kivy.uix.boxlayout import BoxLayout

class LoginScreen(Screen):
    username = ObjectProperty(None)
    password = ObjectProperty(None)

    def validate_login(self):
        # Simple validation (you should implement proper validation)
        if self.username.text == "123" and self.password.text == "123":
            self.manager.current = 'registration'
            self.username.text = ""
            self.password.text = ""
        else:
            self.show_error()

    def show_error(self):
        popup = Popup(title='Error',
                     content=Label(text='Invalid username or password!'),
                     size_hint=(None, None), size=(400, 200))
        popup.open()

class RegistrationScreen(Screen):
    nama = ObjectProperty(None)
    nik = ObjectProperty(None)
    email = ObjectProperty(None)
    hp = ObjectProperty(None)
    
    def validate_registration(self):
        if (self.nama.text and self.nik.text and 
            self.email.text and self.hp.text):
            self.manager.current = 'upload'
        else:
            popup = Popup(title='Error',
                         content=Label(text='All fields are required!'),
                         size_hint=(None, None), size=(400, 200))
            popup.open()

class UploadScreen(Screen):
    selected_file = StringProperty('')

    def select_file(self, selection):
        if selection:
            self.selected_file = selection[0]

    def preview_data(self):
        registration_screen = self.manager.get_screen('registration')
        content = BoxLayout(orientation='vertical', padding=10, spacing=10)
        preview_text = (
            f"Nama: {registration_screen.nama.text}\n"
            f"NIK: {registration_screen.nik.text}\n"
            f"Email: {registration_screen.email.text}\n"
            f"No HP: {registration_screen.hp.text}\n"
            f"Selected File: {self.selected_file}\n"
            f"Legalitas: {registration_screen.ids.spinner_legal.text}\n"
            f"Jasa NIB: {registration_screen.ids.spinner_nib.text}\n"
            f"Merek: {registration_screen.ids.spinner_merek.text}\n"
            f"Perpajakan: {registration_screen.ids.spinner_pajak.text}"
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

    def submit_form(self):
        if self.selected_file:
            popup = Popup(title='Success',
                         content=Label(text='Form submitted successfully!'),
                         size_hint=(None, None), size=(400, 200))
            popup.open()
        else:
            popup = Popup(title='Error',
                         content=Label(text='Please select a file first!'),
                         size_hint=(None, None), size=(400, 200))
            popup.open()

    def logout(self):
        self.manager.current = 'login'
        # Reset form fields
        registration_screen = self.manager.get_screen('registration')
        registration_screen.nama.text = ""
        registration_screen.nik.text = ""
        registration_screen.email.text = ""
        registration_screen.hp.text = ""
        self.selected_file = ""

class SempanerApp(App):
    def build(self):
        sm = ScreenManager()
        sm.add_widget(LoginScreen(name='login'))
        sm.add_widget(RegistrationScreen(name='registration'))
        sm.add_widget(UploadScreen(name='upload'))
        return sm

if __name__ == '__main__':
    SempanerApp().run()