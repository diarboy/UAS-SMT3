from kivy.app import App
from login import LoginScreen
from formscreen import FormScreen

class MyApp(App):
    def build(self):
        self.root_widget = LoginScreen()  # Menggunakan LoginScreen dari login.py
        return self.root_widget

    def switch_to_form(self):
        self.root_widget.clear_widgets()
        self.root_widget.add_widget(FormScreen())  # Beralih ke FormScreen dari formscreen.py

if __name__ == "__main__":
    MyApp().run()
