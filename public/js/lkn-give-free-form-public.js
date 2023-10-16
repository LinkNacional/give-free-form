(function ($) {
  'use strict'

  $(document).ready(function () {
    // Contém a lista com todos os objetos <li></li>.
    const listaPagemento = $('#give-gateway-radio-list')

    // Lista com todos os obj da lista de gateways para selecionar.
    const elemListaPagamento = listaPagemento.find('li')

    // Campos de finalização de compra 'checkout'.
    const checkoutFieldsetWrap = $('#give_purchase_form_wrap')

    // Função que faz o scroll ao clicar numa forma de pagamento.
    function userInfoFieldsScroll () {
      $('html, body').animate({
        scrollTop: checkoutFieldsetWrap.offset().top - 80
      }, 400)
    }

    // Caso exista mais de uma forma de pagamento insere eventos nos elementos HTML.
    if (elemListaPagamento.length !== 1) {
      // Insere eventos em todos os botões.
      for (let c = 0; c < elemListaPagamento.length; c++) {
        // Ao clicar na lista o input também reconhecerá o click e irá rolar para os campos do checkout.
        elemListaPagamento[c].addEventListener('click', function () {
          const nodeChild = elemListaPagamento[c].children
          nodeChild[0].click()
          userInfoFieldsScroll()
        }, false)
      }
    }
  })

  $(window).load(function () {
    // Pega o iframeLoader, caso exista.
    const iframeLoader = $('.iframe-loader').parent().get(0)

    // Verifica a existência do Iframe, especifico dos fomulários Multi-step e Clássico.
    if (!iframeLoader) {
      // Não faz nada.
    } else { // O formulário tem iframe.
      // iframe.
      const iframe = iframeLoader.firstChild.contentDocument.childNodes[0]
      let arrayAux = []

      // Body dentro do iframe.
      filterElementsByClass('give-form-templates', iframe, arrayAux)
      const iframeBody = arrayAux[0]
      arrayAux = []

      // Se o body já estiver disponível é multi-step.
      if (iframeBody !== undefined) {
        // Div do formulário.
        filterElementsByType('DIV', iframeBody, arrayAux)
        const iframeDiv = arrayAux[0]
        arrayAux = []

        // Form.
        filterElementsByType('FORM', iframeDiv, arrayAux)
        const iframeForm = arrayAux[0]
        arrayAux = []

        // Div com aviso de plataforma de doação.
        filterElementsByClass('lkn_notice_wrapper', iframeForm, arrayAux)
        const noticeWrapper = arrayAux[0]
        arrayAux = []

        // Conteúdo do aviso.
        filterElementsByType('A', noticeWrapper, arrayAux)
        const noticeMsg = arrayAux[0]
        arrayAux = []

        // Div do rodapé do formulário.
        filterElementsByClass('form-footer', iframeDiv, arrayAux)
        const iframeFooter = arrayAux[0]
        arrayAux = []

        // Div do aviso de segurança.
        filterElementsByClass('secure-notice', iframeFooter, arrayAux)
        const secureNotice = arrayAux[0]
        arrayAux = []

        // Limpa o conteúdo.
        secureNotice.innerHTML = '<i class="fas fa-lock"></i>'

        // Insere o novo conteúdo.
        secureNotice.append(noticeMsg)

        // Remove o aviso duplicado.
        noticeWrapper.remove()
      } else { // For classic template.
        // Body do formulário clássico.
        filterElementsByClass('give-form-templates give-container-boxed', iframe, arrayAux)
        const iframeBodyC = arrayAux[0]
        arrayAux = []

        // Div que contém o form.
        filterElementsByType('DIV', iframeBodyC, arrayAux)
        const iframeDivC = arrayAux[0]
        arrayAux = []

        // Form.
        filterElementsByType('FORM', iframeDivC, arrayAux)
        const iframeFormC = arrayAux[0]
        arrayAux = []

        // Div com aviso de plataforma de doação.
        filterElementsByClass('lkn_notice_wrapper', iframeFormC, arrayAux)
        const noticeWrapperC = arrayAux[0]
        arrayAux = []

        // Conteúdo do aviso.
        filterElementsByType('A', noticeWrapperC, arrayAux)
        const noticeMsgC = arrayAux[0]
        arrayAux = []

        // Div do rodapé do form.
        filterElementsByClass('give-form-section give-donate-now-button-section', iframeFormC, arrayAux)
        const iframeSecureSectionC = arrayAux[0]
        arrayAux = []

        // Elemento com o aviso original.
        filterElementsByType('ASIDE', iframeSecureSectionC, arrayAux)
        const secureNoticeC = arrayAux[0]
        arrayAux = []

        // Limpa o conteúdo
        secureNoticeC.innerHTML = '<svg class="give-form-secure-icon"><use href="#give-icon-lock"></use></svg>'

        // Insere o novo conteúdo.
        secureNoticeC.append(noticeMsgC)

        // Remove o aviso duplicado.
        noticeWrapperC.remove()
      }
    }
  })

  // Functions for search HTML elements in iframe.

  /**
  * Filter elements by Class in an HTML element.
  *
  **/
  function filterElementsByClass (elementClass, parentElement, elementsArray) {
    for (let i = 0; i < parentElement.childNodes.length; i++) {
      const node = parentElement.childNodes[i]
      if (node.classList && node.classList.value === elementClass) {
        elementsArray.push(node)
      }
    }
  }

  /**
  * Filter elements by type in an HTML element.
  *
  **/
  function filterElementsByType (elementType, parentElement, elementsArray) {
    for (let i = 0; i < parentElement.childNodes.length; i++) {
      const node = parentElement.childNodes[i]
      if (node.nodeType === 1 && node.nodeName === elementType) {
        elementsArray.push(node)
      }
    }
  }

// eslint-disable-next-line no-undef
})(jQuery)
