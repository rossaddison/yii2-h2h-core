<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\modules\invoice\assets;

use yii\web\AssetBundle;

/**
 * Mail application asset
 */
class CoreCustomCssJsAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/invoice/assets';
    
    public $css = [
        'core/css/custom.css',
        'core/css/custom-pdf.css'
    ];
    public $js = [
        //'core/js/dependencies.js',
        'core/js/dependencies.min.js',
        'core/js/jquery-ui.js',
        //'core/js/legacy.js',
        'core/js/legacy.min.js',
       // 'core/js/scripts.js',
        'core/js/h2hscripts.js',
        'core/js/scripts.min.js',
        //'core/js/zxcvbn.js',
        ///'core/js/locales/bootstrap-datepicker.ar.js',
        ///'core/js/locales/bootstrap-datepicker.ar-tn.js',
        ///'core/js/locales/bootstrap-datepicker.az.js',
        ///'core/js/locales/bootstrap-datepicker.bg.js',
        ///'core/js/locales/bootstrap-datepicker.bm.js',
        ///'core/js/locales/bootstrap-datepicker.bn.js',
        ///'core/js/locales/bootstrap-datepicker.br.js',
        ///'core/js/locales/bootstrap-datepicker.bs.js',
        ///'core/js/locales/bootstrap-datepicker.ca.js',
        ///'core/js/locales/bootstrap-datepicker.cs.js',
        ///'core/js/locales/bootstrap-datepicker.cy.js',
        ///'core/js/locales/bootstrap-datepicker.da.js',
        ///'core/js/locales/bootstrap-datepicker.de.js',
        ///'core/js/locales/bootstrap-datepicker.el.js',
        ///'core/js/locales/bootstrap-datepicker.en-AU.js',
        ///'core/js/locales/bootstrap-datepicker.en-CA.js',
        'core/js/locales/bootstrap-datepicker.en-GB.js',
        ///'core/js/locales/bootstrap-datepicker.en-IE.js',
        ///'core/js/locales/bootstrap-datepicker.en-NZ.js',
        ///'core/js/locales/bootstrap-datepicker.en-ZA.js',
        ///'core/js/locales/bootstrap-datepicker.eo.js',
        ///'core/js/locales/bootstrap-datepicker.es.js',
        ///'core/js/locales/bootstrap-datepicker.et.js',
        ///'core/js/locales/bootstrap-datepicker.eu.js',
        ///'core/js/locales/bootstrap-datepicker.fa.js',
        ///'core/js/locales/bootstrap-datepicker.fi.js',
        ///'core/js/locales/bootstrap-datepicker.fo.js',
        ///'core/js/locales/bootstrap-datepicker.fr.js',
        ///'core/js/locales/bootstrap-datepicker.fr-CH.js',
        ///'core/js/locales/bootstrap-datepicker.gl.js',
        ///'core/js/locales/bootstrap-datepicker.he.js',
        ///'core/js/locales/bootstrap-datepicker.hi.js',
        ///'core/js/locales/bootstrap-datepicker.hr.js',
        ///'core/js/locales/bootstrap-datepicker.hu.js',
        ///'core/js/locales/bootstrap-datepicker.hy.js',
        ///'core/js/locales/bootstrap-datepicker.id.js',
        ///'core/js/locales/bootstrap-datepicker.is.js',
        ///'core/js/locales/bootstrap-datepicker.it.js',
        ///'core/js/locales/bootstrap-datepicker.it-CH.js',
        ///'core/js/locales/bootstrap-datepicker.ja.js',
        ///'core/js/locales/bootstrap-datepicker.ka.js',
        //'core/js/locales/bootstrap-datepicker.kh.js',
        ///'core/js/locales/bootstrap-datepicker.kk.js',
        ///'core/js/locales/bootstrap-datepicker.km.js',
        ///'core/js/locales/bootstrap-datepicker.ko.js',
        //'core/js/locales/bootstrap-datepicker.kr.js',
        ///'core/js/locales/bootstrap-datepicker.lt.js',
        ///'core/js/locales/bootstrap-datepicker.lv.js',
        ///'core/js/locales/bootstrap-datepicker.me.js',
        ///'core/js/locales/bootstrap-datepicker.mk.js',
        ///'core/js/locales/bootstrap-datepicker.mn.js',
        ///'core/js/locales/bootstrap-datepicker.ms.js',
        ///'core/js/locales/bootstrap-datepicker.nl.js',
        ///'core/js/locales/bootstrap-datepicker.nl-BE.js',
        ///'core/js/locales/bootstrap-datepicker.no.js',
        ///'core/js/locales/bootstrap-datepicker.oc.js',
        ///'core/js/locales/bootstrap-datepicker.pl.js',
        ///'core/js/locales/bootstrap-datepicker.pt.js',
        ///'core/js/locales/bootstrap-datepicker.pt-BR.js',
        ///'core/js/locales/bootstrap-datepicker.ro.js',
        //'core/js/locales/bootstrap-datepicker.rs.js',
        //'core/js/locales/bootstrap-datepicker.rs-latin.js',
        ///'core/js/locales/bootstrap-datepicker.ru.js',
        ///'core/js/locales/bootstrap-datepicker.si.js',
        ///'core/js/locales/bootstrap-datepicker.sk.js',
        ///'core/js/locales/bootstrap-datepicker.sl.js',
        ///'core/js/locales/bootstrap-datepicker.sq.js',
        ///'core/js/locales/bootstrap-datepicker.sr.js',
        ///'core/js/locales/bootstrap-datepicker.sr-latin.js',
        ///'core/js/locales/bootstrap-datepicker.sv.js',
        ///'core/js/locales/bootstrap-datepicker.sw.js',
        ///'core/js/locales/bootstrap-datepicker.ta.js',
        ///'core/js/locales/bootstrap-datepicker.tg.js',
        ///'core/js/locales/bootstrap-datepicker.th.js',
        ///'core/js/locales/bootstrap-datepicker.tk.js',
        ///'core/js/locales/bootstrap-datepicker.tr.js',
        ///'core/js/locales/bootstrap-datepicker.uk.js',
        ///'core/js/locales/bootstrap-datepicker.uz-cyrl.js',
        ///'core/js/locales/bootstrap-datepicker.uz-latn.js',
        ///'core/js/locales/bootstrap-datepicker.vi.js',
        ///'core/js/locales/bootstrap-datepicker.zh-CN.js',
        ///'core/js/locales/bootstrap-datepicker.zh-TW.js',
        ///'core/js/locales/bootstrap-datepicker.en-CA.js'
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}
