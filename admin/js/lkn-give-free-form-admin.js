(function ($) {
  'use strict'

  // Carregando strings via wp_localize_script.
  const MESSAGE = window.bannerStrings.message
  const LABEL = window.bannerStrings.label

  $(window).on('load', () => {
    // Pega as informações da URL para executar as funções nos locais corretos.
    const urlParams = new URLSearchParams(window.location.search)

    const action = urlParams.get('action')

    const templates = $('.template-info')

    // Onde ficará armazenado o valor do template ativo.
    let templateAtivo = null

    // Procura qual o modelo de template do form, para decidir se irá mostrar o aviso ou não.
    $.each(templates, function (index, elemento) {
      const classes = $(elemento).attr('class').split(' ')
      if (classes.includes('active')) {
        templateAtivo = $(elemento).data('id')
      }
    })

    // Caso seja um template diferente do legacy, mostra o aviso.
    if (templateAtivo !== 'legacy') {
      if (action === 'edit') {
        const painel = $('#titlediv')

        // Cria a div do aviso, coloca os atributos e insere no local correto.
        const noticeDiv = $('<div></div>')
        noticeDiv.addClass('lkn_notice_banner')
        noticeDiv.html(`<strong>${LABEL}</strong>${MESSAGE}`)
        noticeDiv.attr({
          style: 'padding: 14px 6px;background-color: #fcf9e8;color: black;border: solid 1px lightgrey;border-left-color: #dba617;border-left-width: 4px;font-size: 15px;min-width: 630px;margin-top: 16px;'
        })

        painel.append(noticeDiv)
      }
    }
  })

// eslint-disable-next-line no-undef
})(jQuery)
