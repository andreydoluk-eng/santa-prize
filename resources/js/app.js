// Application JS
import 'fslightbox';
import Swal from 'sweetalert2';
import IMask from 'imask';

// Setup Intersection Observer for scroll animations
document.addEventListener('DOMContentLoaded', () => {
    const observerOptions = {
        root: null,
        rootMargin: '-50px 0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                // Optional: stop observing once animated
                // observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const elementsToAnimate = document.querySelectorAll('.animate-on-scroll');
    elementsToAnimate.forEach(el => observer.observe(el));

    // Order Popup Logic
    const orderBtns = document.querySelectorAll('.order-btn');
    orderBtns.forEach(orderBtn => {
        orderBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const title = orderBtn.getAttribute('data-title');
            const image = orderBtn.getAttribute('data-image');
            const url = orderBtn.getAttribute('data-url');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            Swal.fire({
                title: 'Замовити',
                html: `
                    <div class="mb-4">
                        ${image ? `<img src="${image}" alt="${title}" class="rounded-lg mb-3 object-cover max-h-48 mx-auto">` : ''}
                        <h3 class="text-lg font-bold mb-4 whitespace-normal text-white">${title}</h3>
                        <input id="swal-input-name" class="swal2-input !text-white !mt-0 !mb-3 !w-[80%]" placeholder="Ваше ім'я">
                        <input id="swal-input-phone" class="swal2-input !text-white !mt-0 !mb-3 !w-[80%]" placeholder="Телефон" type="tel">
                    </div>
                `,
                confirmButtonText: 'Відправити',
                confirmButtonColor: "#000",
                showCloseButton: true,
                focusConfirm: false,
                theme: 'dark',
                didOpen: () => {
                    const phoneInput = document.getElementById('swal-input-phone');
                    if (phoneInput) {
                        IMask(phoneInput, {
                            mask: '+38 (000) 000-00-00',
                            lazy: false
                        });
                    }
                },
                preConfirm: () => {
                    const name = document.getElementById('swal-input-name').value.trim();
                    const phone = document.getElementById('swal-input-phone').value;
                    const phoneDigits = phone.replace(/\D/g, '');

                    if (!name || !phone) {
                        Swal.showValidationMessage('Будь ласка, заповніть всі поля');
                        return false;
                    }
                    if (phoneDigits.length < 11) {
                        Swal.showValidationMessage('Введіть коректний номер телефону');
                        return false;
                    }

                    return fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            name: name,
                            phone: phone,
                            message: `Сторінка: ${title}`,
                            source_url: window.location.href
                        })
                    })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(json => {
                                    const msg = json.errors ? Object.values(json.errors)[0][0] : (json.message || 'Помилка сервера');
                                    throw new Error(msg);
                                });
                            }
                            return response.json();
                        })
                        .catch(error => {
                            Swal.showValidationMessage(`Помилка: ${error.message}`);
                        });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        theme: 'dark',
                        title: 'Успішно!',
                        text: 'Ваша заявка успішно надіслана. Ми зв\'яжемося з вами найближчим часом.',
                        icon: 'success',
                        timer: 5000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                }
            });
        });
    });

    // Contact form AJAX submission
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        const contactPhone = document.getElementById('contact-phone');
        if (contactPhone) {
            IMask(contactPhone, {
                mask: '+38 (000) 000-00-00',
                lazy: false
            });
        }

        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const formData = new FormData(contactForm);
            formData.append('source_url', window.location.href);

            const phoneStr = formData.get('phone') || '';
            const phoneDigits = phoneStr.replace(/\D/g, '');
            if (phoneDigits.length < 11) {
                Swal.fire({
                    title: 'Помилка!',
                    text: 'Введіть коректний номер телефону',
                    icon: 'error'
                });
                return;
            }

            const url = contactForm.getAttribute('action');

            fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(json => {
                            const msg = json.errors ? Object.values(json.errors)[0][0] : (json.message || 'Помилка сервера');
                            throw new Error(msg);
                        });
                    }
                    return response.json();
                })
                .then(() => {
                    contactForm.reset();
                    Swal.fire({
                        theme: 'dark',
                        title: 'Успішно!',
                        text: 'Ваша заявка успішно надіслана. Ми зв\'яжемося з вами найближчим часом.',
                        icon: 'success',
                        timer: 5000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Помилка!',
                        text: error.message,
                        icon: 'error'
                    });
                });
        });
    }

    // Mobile menu toggle logic
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            const isOpen = mobileMenuBtn.getAttribute('aria-expanded') === 'true';

            if (isOpen) {
                mobileMenu.classList.add('opacity-0', '-translate-y-2', 'pointer-events-none');
                mobileMenu.classList.remove('opacity-100', 'translate-y-0');
                mobileMenuBtn.setAttribute('aria-expanded', 'false');
                mobileMenuBtn.querySelector('.line-1').classList.remove('rotate-45', 'translate-y-[7px]');
                mobileMenuBtn.querySelector('.line-2').classList.remove('opacity-0');
                mobileMenuBtn.querySelector('.line-3').classList.remove('-rotate-45', '-translate-y-[7px]');
            } else {
                mobileMenu.classList.remove('opacity-0', '-translate-y-2', 'pointer-events-none');
                mobileMenu.classList.add('opacity-100', 'translate-y-0');
                mobileMenuBtn.setAttribute('aria-expanded', 'true');
                mobileMenuBtn.querySelector('.line-1').classList.add('rotate-45', 'translate-y-[7px]');
                mobileMenuBtn.querySelector('.line-2').classList.add('opacity-0');
                mobileMenuBtn.querySelector('.line-3').classList.add('-rotate-45', '-translate-y-[7px]');
            }
        });

        // Close mobile menu on link click
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('opacity-0', '-translate-y-2', 'pointer-events-none');
                mobileMenu.classList.remove('opacity-100', 'translate-y-0');
                mobileMenuBtn.setAttribute('aria-expanded', 'false');
                mobileMenuBtn.querySelector('.line-1').classList.remove('rotate-45', 'translate-y-[7px]');
                mobileMenuBtn.querySelector('.line-2').classList.remove('opacity-0');
                mobileMenuBtn.querySelector('.line-3').classList.remove('-rotate-45', '-translate-y-[7px]');
            });
        });
    }

    // Header scroll background logic
    const header = document.getElementById('main-header');
    if (header) {
        const handleScroll = () => {
            if (window.scrollY > 50) {
                header.classList.add('bg-background/80', 'backdrop-blur-xl', 'border-b', 'border-border');
                header.classList.remove('bg-transparent', 'border-transparent');
            } else {
                header.classList.remove('bg-background/80', 'backdrop-blur-xl', 'border-b', 'border-border');
                header.classList.add('bg-transparent', 'border-transparent');
            }
        };

        window.addEventListener('scroll', handleScroll);
        handleScroll(); // Initial check
    }
});
