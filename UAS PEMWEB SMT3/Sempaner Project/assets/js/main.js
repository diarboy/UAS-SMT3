(function() {
  "use strict";

  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */

  function toggleScrolled() {
    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');
    if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavToggleBtn.classList.toggle('bi-list');
    mobileNavToggleBtn.classList.toggle('bi-x');
  }
  mobileNavToggleBtn.addEventListener('click', mobileNavToogle);

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navmenu a').forEach(navmenu => {
    navmenu.addEventListener('click', () => {
      if (document.querySelector('.mobile-nav-active')) {
        mobileNavToogle();
      }
    });

  });

  /**
   * Toggle mobile nav dropdowns
   */
  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
    navmenu.addEventListener('click', function(e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
    });
  });

  /*=============== CONTACT FORM ===============*/
  
  document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('form');
    const feedback = document.getElementById("formFeedback");
    const fileInput = document.getElementById('files');
    const fileFeedback = document.getElementById('fileFeedback');
    const maxFileSize = 2 * 1024 * 1024;
    const statusRadios = document.querySelectorAll('input[name="pelaku"]');
    const uploadSuratKuasa = document.getElementById('uploadSuratKuasa');
  
    flatpickr("#lahir", {
        dateFormat: "d/m/Y",
        allowInput: true,
    });
  
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        const dateInput = document.getElementById("lahir").value;
        const datePattern = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(\d{4})$/;
  
        if (!datePattern.test(dateInput)) {
            feedback.textContent = 'Format tanggal tidak valid. Gunakan dd/mm/yyyy.';
            feedback.style.display = 'block';
            return;
        }
  
        if (!fileInput.files.length) {
            feedback.textContent = 'Anda harus mengunggah dokumen.';
            feedback.style.display = 'block';
            return;
        }
  
        const file = fileInput.files[0];
        if (file.size > maxFileSize) {
            feedback.textContent = 'Ukuran file tidak boleh lebih dari 2 MB.';
            feedback.style.display = 'block';
            return;
        }
  
        feedback.textContent = 'Formulir berhasil dikirim!';
        feedback.style.display = 'block';
        form.reset();
  
        setTimeout(() => {
            feedback.style.display = 'none';
        }, 10000);
    });
  
    statusRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === 'Selaku Kuasa') {
                uploadSuratKuasa.style.display = 'block';
            } else {
                uploadSuratKuasa.style.display = 'none';
            }
        });
    });
  
    fileInput.addEventListener('change', function () {
        const file = fileInput.files[0];
        fileFeedback.style.display = 'none';
        fileFeedback.classList.remove('error', 'success');
  
        if (file && file.size > maxFileSize) {
            fileFeedback.textContent = 'Ukuran file tidak boleh lebih dari 2 MB.';
            fileFeedback.style.display = 'block';
            fileInput.value = '';
        }
    });
  });
  /*=============== CONTACT FORM ===============*/

  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove();
    });
  }

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector('.scroll-top');

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
  }
  scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);

  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', aosInit);

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  /**
   * Frequently Asked Questions Toggle
   */
  document.querySelectorAll('.faq-item h3, .faq-item .faq-toggle').forEach((faqItem) => {
    faqItem.addEventListener('click', () => {
      faqItem.parentNode.classList.toggle('faq-active');
    });
  });
  
})();