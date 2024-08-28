// js/button-click-script.js

jQuery(document).ready(function ($) {
    $('form').on('submit', function (e) {
        e.preventDefault(); // Previne o envio normal do formulário

        $.ajax({
            url: ajax_params.ajax_url,
            method: 'POST',
            data: {
                action: 'registrar_clique_botao',
                acao: 'chamar_atendimento'
            },
            success: function (response) {
                if (response.success) {
                    // Faça algo se necessário
                    console.log('Clique registrado com sucesso.');
                } else {
                    console.log('Erro ao registrar clique:', response.data);
                }
            }
        });
    });
});
