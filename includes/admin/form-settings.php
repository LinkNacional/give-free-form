<?php
// Exit if access directly.
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Example code to show how to add metabox tab to give form data settings.
 *
 * @package     Give
 * @copyright   Copyright (c) 2020, Impress.org
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class Lkn_Free_Form_Settings {
	/**
	 * Give_Metabox_Setting_Fields constructor.
	 */
	public function __construct() {
		$this->id = 'free_form-fields';
		$this->prefix = '_free_form_';
		add_filter('give_metabox_form_data_settings', [$this, 'setup_setting'], 999);
	}

	public function setup_setting($settings) {
		// Custom metabox settings.
		$settings["{$this->id}_tab"] = [
			'id' => "{$this->id}_tab",
			'title' => __('Estilização do Formulário', 'lkn-give-free-form'),
			'icon-html' => '<span class="dashicons dashicons-format-aside"></span>',
			'fields' => [
				[
					'id' => "{$this->id}_lkn_form_style_disabled",
					'name' => '',
					'type' => 'disabled_for_non_legacy_templates_html',
					'callback' => [$this, 'disabled_for_non_legacy_templates_html'],
				],
				[
					'id' => "{$this->id}_lkn_form_style_status",
					'name' => __('Habilitar', 'lkn-give-free-form'),
					'type' => 'radio_inline',
					'desc' => __('Habilita a estilização do formulário legado.', 'lkn-give-free-form'),
					'options' => [
						'enabled' => __('Habilitado', 'lkn-give-free-form'),
						'disabled' => __('Desabilitado', 'lkn-give-free-form'),
					],
					'default' => 'disabled',
				],
				[
					'id' => "{$this->id}_lkn_form_color",
					'name' => __('Cor primária.', 'lkn-give-free-form'),
					'desc' => __('A cor primária é usada em todo o modelo de formulário para vários elementos, incluindo botões, quebras de linha e elementos de foco. Defina uma cor que reflita sua marca ou imagem em destaque para obter os melhores resultados.', 'lkn-give-free-form'),
					'type' => 'colorpicker',
					'default' => '#2bc253',
				],
				[
					'id' => "{$this->id}_lkn_details_color",
					'name' => __('Cor secundária.', 'lkn-give-free-form'),
					'desc' => __('A cor secundária é utilizadas em detalhes do site e destaque para as palavras.', 'lkn-give-free-form'),
					'type' => 'colorpicker',
					'default' => '#ffffff',
				],
				[
					'id' => "{$this->id}_lkn_title_color",
					'name' => __('Cor dos títulos.', 'lkn-give-free-form'),
					'desc' => __('Define a cor da fonte das seções do formulário.', 'lkn-give-free-form'),
					'type' => 'colorpicker',
					'default' => '#666',
				],
				[
					'id' => "{$this->id}_lkn_btn_border_color",
					'name' => __('Cor das bordas dos botões.', 'lkn-give-free-form'),
					'desc' => __('Define a cor das bordas para os botões de seleção de valor e de método de pagamento.', 'lkn-give-free-form'),
					'type' => 'colorpicker',
					'default' => '#ccc',
				],
				[
					'id' => "{$this->id}_lkn_title_size",
					'name' => __('Tamanho dos títulos.', 'lkn-give-free-form'),
					'desc' => __('Define o tamanho da fonte das seções do formulário. É definida em px.', 'lkn-give-free-form'),
					'type' => 'number',
					'default' => '16',
				],
				[
					'id' => "{$this->id}_lkn_section_margin",
					'name' => __('Espaçamento entre as seções.', 'lkn-give-free-form'),
					'desc' => __('A margem utilizada para separar as seções do formulário, apenas margem vertical. É definida em px.', 'lkn-give-free-form'),
					'type' => 'number',
					'default' => '10',
				],
				[
					'id' => "{$this->id}_lkn_btn_border_size",
					'name' => __('Tamanho das bordas dos botões.', 'lkn-give-free-form'),
					'desc' => __('Define o tamanho das bordas dos botões de seleção de valor e de seleção de pagamento. É definida em px.', 'lkn-give-free-form'),
					'type' => 'number',
					'default' => '2',
				],
				[
					'id' => "{$this->id}_lkn_btn_border_radius",
					'name' => __('Tipos de Bordas.', 'lkn-give-free-form'),
					'type' => 'radio_inline',
					'desc' => __('Escolha o tipo de borda, para os botões de formulario.', 'lkn-give-free-form'),
					'options' => [
						'0' => __('Quadradas', 'lkn-give-free-form'),
						'15' => __('Arredondadas', 'lkn-give-free-form'),
					],
					'default' => '0',
				],
				[
					'id' => "{$this->id}_lkn_btn_paddingA",
					'name' => __('Altura dos Botões.', 'lkn-give-free-form'),
					'desc' => __('Escolha o altura das caixas dos botões. É definido em px.', 'lkn-give-free-form'),
					'type' => 'number',
					'default' => '15',
				],
				[
					'id' => "{$this->id}_lkn_btn_paddingL",
					'name' => __('Largura dos Botões.', 'lkn-give-free-form'),
					'desc' => __('Escolha a largura das caixas dos botões. É definido em px.', 'lkn-give-free-form'),
					'type' => 'number',
					'default' => '50',
				],
				[
					'id' => "{$this->id}_lkn_btn_text_size",
					'name' => __('Tamanho da Fonte do Texto dos Botões.', 'lkn-give-free-form'),
					'desc' => __('Escolha o tamanho da fonte do texto do conteúdo dos botões. É definido em Em', 'lkn-give-free-form'),
					'type' => 'text',
					'default' => '1',
				],
			],
		];

		return $settings;
	}

	/**
	 * Add a form admin notice
	 *
	 * @return string $html
	 *
	 */
	public function disabled_for_non_legacy_templates_html() {
		ob_start(); ?>
			<p class="ffconfs-disabled"><?php _e('O formulário customizado não é relevante para o formulário Multi-Step do giveWP. Caso você deseje utilizar o Free Form Plugin é necessário mudar o Template do formulário para opção "Legado".', 'lkn-give-free-form-notices'); ?></p>
		<?php

		$html = ob_get_contents();

		return $html;
	}
}
new Lkn_Free_Form_Settings();
