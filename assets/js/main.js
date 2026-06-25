/**
 * SmartTutor Frontend Logic
 * Handles UI interactions, role toggling, and form UI validation.
 */

document.addEventListener('DOMContentLoaded', () => {

    // 1. Password Visibility Toggle
    const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    togglePasswordButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    });

    // 2. Role Toggling (Login & Register Pages)
    const roleTabs = document.querySelectorAll('.role-tab');
    
    roleTabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all tabs
            roleTabs.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');

            const selectedRole = this.getAttribute('data-role'); // 'student' or 'tutor'

            // --- Register Page Logic ---
            const studentFields = document.getElementById('student-fields');
            const tutorFields = document.getElementById('tutor-fields');
            const regIllustration = document.getElementById('register-illustration');

            if (studentFields && tutorFields) {
                if (selectedRole === 'student') {
                    studentFields.classList.add('active');
                    tutorFields.classList.remove('active');
                    if (regIllustration) regIllustration.src = '../assets/images/student-reg.svg';
                } else {
                    tutorFields.classList.add('active');
                    studentFields.classList.remove('active');
                    if (regIllustration) regIllustration.src = '../assets/images/tutor-reg.svg';
                }
            }

            // --- Login Page Logic ---
            const loginIllustration = document.getElementById('login-illustration');
            const loginTitle = document.getElementById('login-title');

            if (loginIllustration && loginTitle) {
                if (selectedRole === 'student') {
                    loginTitle.innerText = "Welcome back, Student!";
                    loginIllustration.src = '../assets/images/student-login.svg';
                } else {
                    loginTitle.innerText = "Welcome back, Tutor!";
                    loginIllustration.src = '../assets/images/tutor-login.svg';
                }
            }
        });
    });

    // 3. Password Strength Indicator (UI Only)
    const passwordInput = document.getElementById('password');
    const strengthBar = document.getElementById('strength-bar');
    const strengthText = document.getElementById('strength-text');

    if (passwordInput && strengthBar) {
        passwordInput.addEventListener('input', function() {
            const val = this.value;
            strengthBar.className = 'password-strength-bar'; // reset

            if (val.length === 0) {
                strengthBar.style.width = '0%';
                strengthText.innerText = '';
            } else if (val.length < 6) {
                strengthBar.classList.add('strength-weak');
                strengthText.innerText = 'Weak';
                strengthText.className = 'small mt-1 text-danger';
            } else if (val.length < 10) {
                strengthBar.classList.add('strength-medium');
                strengthText.innerText = 'Medium';
                strengthText.className = 'small mt-1 text-warning';
            } else {
                strengthBar.classList.add('strength-strong');
                strengthText.innerText = 'Strong';
                strengthText.className = 'small mt-1 text-success';
            }
        });
    }

    // 4. Confirm Password Match Indicator (UI Only)
    const confirmPasswordInput = document.getElementById('confirm-password');
    const matchIcon = document.getElementById('match-icon');

    if (passwordInput && confirmPasswordInput && matchIcon) {
        const checkMatch = () => {
            if (confirmPasswordInput.value === '') {
                matchIcon.className = 'bi bi-shield-lock text-muted';
            } else if (passwordInput.value === confirmPasswordInput.value) {
                matchIcon.className = 'bi bi-check-circle-fill text-success';
            } else {
                matchIcon.className = 'bi bi-x-circle-fill text-danger';
            }
        };

        passwordInput.addEventListener('input', checkMatch);
        confirmPasswordInput.addEventListener('input', checkMatch);
    }
});
