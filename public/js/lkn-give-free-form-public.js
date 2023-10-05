(function ($) {
  'use strict'

  $(document).ready(function () {
    const listaPagemento = $('#give-gateway-radio-list') // Contém a lista com todos os objetos <li></li>
    const elemListaPagamento = listaPagemento.find('li') // lista com todos os obj da lista de gateways para elecionar
    const checkoutFieldsetWrap = $('#give_purchase_form_wrap') // campos de finalização de compra checkout

    // função que da scroll ao clicar numa forma de pagamento
    const userInfoFieldsScroll = function () {
      checkoutFieldsetWrap.animate({
        scrollTop: $('#give-purchase-button').offset().top
      }, 10000)
    }

    // Caso exista mais de 1 forma de pagamento insere eventos nos elementos html
    if (elemListaPagamento.length !== 1) {
      // insere eventos em todos os botões
      for (let c = 0; c < elemListaPagamento.length; c++) {
        // Ao clicar na lista o input também reconhecerá o click e irá rolar para os campos do checkout
        elemListaPagamento[c].click(function () {
          console.log('clicou') // TODO fazer funcionar.
        })
      }
    }
  })

// eslint-disable-next-line no-undef
})(jQuery)
