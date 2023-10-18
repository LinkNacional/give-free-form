(function ($) {
  'use strict'

  // Load strings via wp_localize_script.
  const MESSAGE = window.bannerStrings.message
  const LABEL = window.bannerStrings.label

  $(window).on('load', () => {
    // Catch URL information for running function on correct places.
    const urlParams = new URLSearchParams(window.location.search)

    const action = urlParams.get('action')

    const templates = $('.template-info')

    // Variable for active template.
    let templateAtivo = null

    // Search the active form template to decide show warning or not.
    $.each(templates, function (index, elemento) {
      const classes = $(elemento).attr('class').split(' ')
      if (classes.includes('active')) {
        templateAtivo = $(elemento).data('id')
      }
    })

    // If form template is different of 'Legacy', show warning.
    if (templateAtivo !== 'legacy') {
      if (action === 'edit') {
        const painel = $('#titlediv')

        // Create the warning div, set the attributes and insert on correct place.
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
