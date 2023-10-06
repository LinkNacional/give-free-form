(function ($) {
  'use strict'

  $(document).ready(function () {
    const listaPagemento = $('#give-gateway-radio-list') // Contém a lista com todos os objetos <li></li>.
    const elemListaPagamento = listaPagemento.find('li') // Lista com todos os obj da lista de gateways para selecionar.
    const checkoutFieldsetWrap = $('#give_purchase_form_wrap') // Campos de finalização de compra 'checkout'.

    // função que faz o scroll ao clicar numa forma de pagamento
    function userInfoFieldsScroll () {
      $('html, body').animate({
        scrollTop: checkoutFieldsetWrap.offset().top - 80
      }, 750)
    }

    const elemChildrens = elemListaPagamento.children()

    elemChildrens.click(() => userInfoFieldsScroll())
  })

  // TODO continuar daqui para baixo.
  $(window).load(function () {
    const iframeLoader = $('.iframe-loader').parent().get(0)

    // If it is a legacy form, also modify the form attributes for GiveWP validation.
    // Verify for the existence of the iframe loader, specific to the multi-step form.
    if (!iframeLoader) {

    // The form have iframe.
    } else {
      const iframeBody = iframeLoader.firstChild.contentDocument.childNodes[1].childNodes[1]
      let arrayAux = []

      filterElementsByClass('give-form-wrap give-embed-form give-viewing-form-in-iframe', iframeBody, arrayAux)
      const iframeForm = arrayAux[0]
      arrayAux = []

      filterElementsByType('FORM', iframeForm, arrayAux)
      const iframeFormDiv = arrayAux[0]
      arrayAux = []

      console.log(iframeFormDiv)

      // filterElementsByClass('give-form-section give-donation-amount-section', iframeFormDiv, arrayAux)
      // const iframeRecaptchaSection = arrayAux[0]
      // arrayAux = []

      // // For classic template
      // if (iframeRecaptchaSection !== undefined) {
      //   filterElementsById('g-recaptcha-lkn-input', iframeRecaptchaSection, arrayAux)
      //   arrayAux = []

      //   // For multi step template
      // } else {
      //   filterElementsByClass('give-section choose-amount', iframeFormDiv, arrayAux)
      //   const iframeRecaptchaSection = arrayAux[0]
      //   arrayAux = []

      //   filterElementsById('g-recaptcha-lkn-input', iframeRecaptchaSection, arrayAux)
      //   arrayAux = []
      // }
    }
  })

  // Functions for search HTML elements in iframe.
  /**
  * Filter elements by ID in an HTML element.
  *
  * @return
  **/
  function filterElementsById (elementId, parentElement, elementsArray) {
    for (let i = 0; i < parentElement.childNodes.length; i++) {
      const node = parentElement.childNodes[i]
      if (node.nodeType === 1 && node.id === elementId) {
        elementsArray.push(node)
      }
    }
  }

  /**
  * Filter elements by Class in an HTML element.
  *
  * @return
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
  * @return
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
