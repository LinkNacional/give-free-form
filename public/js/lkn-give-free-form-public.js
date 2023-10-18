(function ($) {
  'use strict'

  $(document).ready(function () {
    // Contains the list of all <li></li> elements.
    const listaPagemento = $('#give-gateway-radio-list')

    // List with all obj of gateways to select.
    const elemListaPagamento = listaPagemento.find('li')

    // Checkout fields.
    const checkoutFieldsetWrap = $('#give_purchase_form_wrap')

    // Function to make page scroll after select a payment method.
    function userInfoFieldsScroll () {
      $('html, body').animate({
        scrollTop: checkoutFieldsetWrap.offset().top - 80
      }, 400)
    }

    // If exists more of one payment method, insert the scroll animation in all of them.
    if (elemListaPagamento.length !== 1) {
      // Insert event in all of buttons.
      for (let c = 0; c < elemListaPagamento.length; c++) {
        // On click the list, the input will be scrolling for the checkout fields.
        elemListaPagamento[c].addEventListener('click', function () {
          const nodeChild = elemListaPagamento[c].children
          nodeChild[0].click()
          userInfoFieldsScroll()
        }, false)
      }
    }
  })

  $(window).load(function () {
    // Catch the iframeLoader, if exists.
    const iframeLoader = $('.iframe-loader').parent().get(0)

    // Verify the existence of Iframe, specific of multi-step and classic template forms.
    if (!iframeLoader) {
      // Does not do anything.
    } else { // The form have iframe.
      // iframe.
      const iframe = iframeLoader.firstChild.contentDocument.childNodes[0]
      let arrayAux = []

      // Body inside the iframe.
      filterElementsByClass('give-form-templates', iframe, arrayAux)
      const iframeBody = arrayAux[0]
      arrayAux = []

      // If body is definid, the form is multi-step.
      if (iframeBody !== undefined) {
        // Div of form.
        filterElementsByType('DIV', iframeBody, arrayAux)
        const iframeDiv = arrayAux[0]
        arrayAux = []

        // Form.
        filterElementsByType('FORM', iframeDiv, arrayAux)
        const iframeForm = arrayAux[0]
        arrayAux = []

        // Div with secure donation platform notice.
        filterElementsByClass('lkn_notice_wrapper', iframeForm, arrayAux)
        const noticeWrapper = arrayAux[0]
        arrayAux = []

        // Notice content.
        filterElementsByType('A', noticeWrapper, arrayAux)
        const noticeMsg = arrayAux[0]
        arrayAux = []

        // Div of form footer.
        filterElementsByClass('form-footer', iframeDiv, arrayAux)
        const iframeFooter = arrayAux[0]
        arrayAux = []

        // Div of secure notice.
        filterElementsByClass('secure-notice', iframeFooter, arrayAux)
        const secureNotice = arrayAux[0]
        arrayAux = []

        // Clean the content.
        secureNotice.innerHTML = '<i class="fas fa-lock"></i>'

        // Insert the new content.
        secureNotice.append(noticeMsg)

        // Remove the duplicate content.
        noticeWrapper.remove()
      } else { // For classic template.
        // Body of classic form.
        filterElementsByClass('give-form-templates give-container-boxed', iframe, arrayAux)
        const iframeBodyC = arrayAux[0]
        arrayAux = []

        // Div with the form.
        filterElementsByType('DIV', iframeBodyC, arrayAux)
        const iframeDivC = arrayAux[0]
        arrayAux = []

        // Form.
        filterElementsByType('FORM', iframeDivC, arrayAux)
        const iframeFormC = arrayAux[0]
        arrayAux = []

        // Div with secure donation platform notice.
        filterElementsByClass('lkn_notice_wrapper', iframeFormC, arrayAux)
        const noticeWrapperC = arrayAux[0]
        arrayAux = []

        // Notice content.
        filterElementsByType('A', noticeWrapperC, arrayAux)
        const noticeMsgC = arrayAux[0]
        arrayAux = []

        // Div of form footer.
        filterElementsByClass('give-form-section give-donate-now-button-section', iframeFormC, arrayAux)
        const iframeSecureSectionC = arrayAux[0]
        arrayAux = []

        // Original element with the secure notice.
        filterElementsByType('ASIDE', iframeSecureSectionC, arrayAux)
        const secureNoticeC = arrayAux[0]
        arrayAux = []

        // Clean the content.
        secureNoticeC.innerHTML = '<svg class="give-form-secure-icon"><use href="#give-icon-lock"></use></svg>'

        // Insert the new content.
        secureNoticeC.append(noticeMsgC)

        // Remove the duplicated notice.
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
