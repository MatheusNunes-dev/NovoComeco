document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const emailInput = document.querySelector('#email');
    const senhaInput = document.querySelector('#password');
    const submitButton = document.querySelector('.action-button');
    
    // Função de validação do formulário
    function validateForm(event) {
        let valid = true;
        
        // Validações de email
        if (emailInput.value === '') {
            emailInput.style.borderColor = '#FF4D4D'; // Vermelho
            valid = false;
        } else {
            emailInput.style.borderColor = '#ccc'; // Resetando a borda
        }
        
        // Validações de senha
        if (senhaInput.value === '') {
            senhaInput.style.borderColor = '#FF4D4D'; // Vermelho
            valid = false;
        } else {
            senhaInput.style.borderColor = '#ccc'; // Resetando a borda
        }
        
        if (!valid) {
            event.preventDefault();
        }
    }

    // Aplica a validação ao submeter o formulário
    form.addEventListener('submit', validateForm);
});
