<?php
use yii\helpers\Url;
use yii\helpers\Utilities;
use Yii;
$js = <<< 'SCRIPT'
    function getIcon(fullname) {
        var fileFormat = fullname.match(/\.([A-z0-9]{1,5})$/);
        if (fileFormat) {
            fileFormat = fileFormat[1];
        }
        else {
            fileFormat = '';
        }

        var fileIcon = 'default';

        switch (fileFormat) {
            case 'pdf':
                fileIcon = 'file-pdf';
                break;

            case 'mp3':
            case 'wav':
            case 'ogg':
                fileIcon = 'file-audio';
                break;

            case 'doc':
            case 'docx':
            case 'odt':
                fileIcon = 'file-document';
                break;

            case 'xls':
            case 'xlsx':
            case 'ods':
                fileIcon = 'file-spreadsheet';
                break;

            case 'ppt':
            case 'pptx':
            case 'odp':
                fileIcon = 'file-presentation';
                break;
        }
        return fileIcon;
    }

    // Get the template HTML and remove it from the document
    var previewNode = document.querySelector('#template');
    previewNode.id = '';
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: '<?php echo Url::to(['/upload/uploadfile','product_id' => $invoice->product_id, 'invoice_url_key' => $invoice->invoice_url_key]); ?>',
        params: {
            '<?= Yii::$app->request->getCsrfToken(); ?>': Cookies.get('<?= Yii::$app->request->csrfParam; ?>'),
        },
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        uploadMultiple: false,
        dictRemoveFileConfirmation: '<?= Utilities::trans('delete_attachment_warning'); ?>',
        previewTemplate: previewTemplate,
        autoQueue: true, // Make sure the files aren't queued until manually added
        previewsContainer: '#previews', // Define the container to display the previews
        clickable: '.fileinput-button', // Define the element that should be used as click trigger to select files.
        init: function () {
            thisDropzone = this;
            $.getJSON('<?php echo Url::to(['/upload/uploadfile','product_id' => $invoice->product_id, 'invoice_url_key'=>$invoice->invoice_url_key]) ?>',
                function (data) {
                    $.each(data, function (index, val) {
                        var mockFile = {fullname: val.fullname, size: val.size, name: val.name};

                        thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                        createDownloadButton(mockFile, '<?php echo Url::to(['/upload/getfile','filename'=>val.fullname]); ?>');

                        if (val.fullname.match(/\.(jpg|jpeg|png|gif)$/)) {
                            thisDropzone.options.thumbnail.call(thisDropzone, mockFile,
                                '<?php echo Url::to(['/upload/getfile','filename'=>val.fullname]); ?>');
                        }
                        else {
                            fileIcon = getIcon(val.fullname);
                            thisDropzone.options.thumbnail.call(thisDropzone, mockFile,
                                '<?php echo \Yii::getAlias('@webroot'). "/modules/invoice/assets/core/img/file-icons/";?>' + fileIcon + '.svg');
                        }

                        thisDropzone.emit('complete', mockFile);
                        thisDropzone.emit('success', mockFile);
                    });
                });
        },
    });

    myDropzone.on('success', function (file, response) {
        <?php echo(YII_DEBUG ? 'console.log(response);' : ''); ?>
        if (typeof response !== 'undefined') {
            response = JSON.parse(response);
            if (response.success !== true) {
                alert(response.message);
            }
        }
    });

    myDropzone.on('addedfile', function (file) {
        var fileIcon = getIcon(file.name);
        myDropzone.emit('thumbnail', file,
            '<?php echo \Yii::getAlias('@webroot')."modules/invoice/assets/core/img/file-icons/"); ?>' + fileIcon + '.svg');
        createDownloadButton(file, '<?php echo Url::to(['upload/getfile','invoice_url_key' => $invoice->invoice_url_key]); ?>'.'_'. +
            file.name.replace(/\s+/g, '_'));
    });

    // Update the total progress bar
    myDropzone.on('totaluploadprogress', function (progress) {
        document.querySelector('#total-progress .progress-bar').style.width = progress + '%';
    });

    myDropzone.on('sending', function (file) {
        // Show the total progress bar when upload starts
        document.querySelector('#total-progress').style.opacity = '1';
    });

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on('queuecomplete', function (progress) {
        document.querySelector('#total-progress').style.opacity = '0';
    });

    myDropzone.on('removedfile', function (file) {
        $.post({
            url: '<?php echo Url::to(['/upload/deletefile','invoice_url_key' => $invoice->invoice_url_key]) ?>',
            data: {
                'name': file.name.replace(/\s+/g, '_'),
                <?= Yii::$app->request->getCsrfToken(); ?>: Cookies.get('<?=Yii::$app->request->csrfParam ?>')
            }
        }, function (response) {
            <?php echo(YII_DEBUG ? 'console.log(response);' : ''); ?>
        }

    );
    });

    function createDownloadButton(file, fileUrl) {
        var downloadButtonList = file.previewElement.querySelectorAll('[data-dz-download]');
        for (var $i = 0; $i < downloadButtonList.length; $i++) {
            downloadButtonList[$i].addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                location.href = fileUrl;
                return false;
            });
        }
    };
SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js);
?>