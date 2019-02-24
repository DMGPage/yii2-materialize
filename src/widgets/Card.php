<?php
/**
 * @link https://github.com/DMGPage/yii2-materialize
 * @copyright Copyright (c) 2018 Dmitrijs Reinmanis
 * @license https://github.com/DMGPage/yii2-materialize/blob/master/LICENSE
 */

namespace dmgpage\yii2materialize\widgets;

use yii\base\Widget as BaseWidget;
use dmgpage\yii2materialize\helpers\Html;

/**
 * Cards are a convenient means of displaying content composed of different types of objects.
 * They’re also well-suited for presenting similar objects whose size or supported actions can vary considerably,
 * like photos with captions of variable length.
 * 
 */
class Card extends BaseWidget
{
    /**
     * @var array the HTML attributes for the row container tag of the card view.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $rowOptions = [];

    /**
     * @var array the HTML attributes for the column container tag of the card view.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $colOptions = ['class' => 's12 m6'];

    /**
     * @var array the HTML attributes for the card container tag of the card view.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array the HTML attributes for the card content wrapper tag of the card view.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $contentOptions = [];

    /**
     * @var string title of the card
     */
    public $cardTitle;

    /**
     * @var array the HTML attributes for the card title tag of the card view. Uses only if "cardTitle" attribute is specified.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $titleOptions = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();

        $options = ['class' => 'card'];
        Html::addCssClass($this->options, $options);
        $contentOptions = ['class' => 'card-content'];
        Html::addCssClass($this->contentOptions, $contentOptions);

        $html = Html::beginGridRow($this->rowOptions);
        $html .= Html::beginGridCol($this->colOptions);
        $html .= Html::beginTag('div', $this->options);
        $html .= Html::beginTag('div', $this->contentOptions);

        if (!empty($this->cardTitle)) {
            $titleOptions = ['class' => 'card-title'];
            Html::addCssClass($this->titleOptions, $titleOptions);
            $html .= Html::tag('span', $this->cardTitle, ['class' => 'card-title']);
        }

        echo $html;
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $html = Html::endTag('div');
        $html = Html::endTag('div');
        $html .= Html::endGridCol();
        $html .= Html::endGridRow();

        echo $html;
    }
}
