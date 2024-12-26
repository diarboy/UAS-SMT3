from kivy.app import App
from kivy.uix.boxlayout import BoxLayout
from kivy.uix.button import Button
from kivy.uix.label import Label
from kivy.uix.popup import Popup
from kivy.uix.filechooser import FileChooserIconView
from kivy.lang import Builder

class TestFileChooser(BoxLayout):
    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.selected_file = None
        
    def choose_file(self):
        content = FileChooserIconView(
            path='.',  # Mulai dari direktori saat ini
        )
        content.bind(selection=self.select_file)
        
        self._popup = Popup(
            title="Pilih File",
            content=content,
            size_hint=(0.9, 0.9)
        )
        self._popup.open()

    def select_file(self, instance, selection):
        if selection:
            self.selected_file = selection[0]
            self.ids.file_label.text = f'File terpilih:\n{self.selected_file}'
            self._popup.dismiss()

class TestApp(App):
    def build(self):
        return TestFileChooser()

if __name__ == '__main__':
    TestApp().run()