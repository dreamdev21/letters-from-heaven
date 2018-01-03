<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('site/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300|Lobster|Architects+Daughter|Roboto|Oswald|Montserrat|Lora|PT+Sans|Ubuntu|Roboto+Slab|Fjalla+One|Indie+Flower|Playfair+Display|Poiret+One|Dosis|Oxygen|Lobster|Play|Shadows+Into+Light|Pacifico|Dancing+Script|Kaushan+Script|Gloria+Hallelujah|Black+Ops+One|Lobster+Two|Satisfy|Pontano+Sans|Domine|Russo+One|Handlee|Courgette|Special+Elite|Amaranth|Vidaloka'
          rel='stylesheet' type='text/css'>

    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="57x57" href="/emailedit/images/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/emailedit/images/favicons/apple-touch-icon-60x60.png">
    <link rel="manifest" href="/emailedit/images/favicons/manifest.json">
    <link rel="mask-icon" href="/emailedit/images/favicons/safari-pinned-tab.svg">
    <meta name="msapplication-TileColor">
    <meta name="theme-color">

    <!-- CSS Start -->
    <link rel="stylesheet" type="text/css" href="/emailedit/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/emailedit/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/emailedit/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/emailedit/css/ng-scrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="/emailedit/css/style.css">
    <link rel="stylesheet" type="text/css" href="/emailedit/css/custom.css">
    <link rel="stylesheet" type="text/css" href="/emailedit/css/fonts.css">
    <link rel="stylesheet" type="text/css" href="/emailedit/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" type="text/css" href="/emailedit/css/angular-material.css">
    <!--<link id="ThemeRoller" href="css/themes/color_1.css" type="text/css" rel="stylesheet">-->
    <!-- CSS End -->

    <script type="text/javascript" src="/emailedit/js/jquery.js"></script>
    <script type="text/javascript" src="/emailedit/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container ng-scope index_02" ng-controller="ProductCtrl" ng-app="productApp" id="productApp">
        <div ng-show="loading" class="loading">
            <h1 class="lodingMessage">Initializing Design Tool<img src="/emailedit/images/ajax-loader.gif"></h1>
        </div>
        <div class="row clearfix" ng-cloak>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 editor_section">
                <div id="content" class="tabing">
                    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                        <li class="active">

                            <a class="text" href="#text_design" aria-controls="text_design" role="tab" data-toggle="tab"
                               ng-click="deactivateAll()">
                                <i class="fa fa-font"></i>
                                <span>Text Design</span>
                            </a>

                        </li>
                        <!--<li>-->
                        <!--<a ng-click="deactivateAll()" href="#Products" class="products" data-toggle="tab">-->
                        <!--<i class="glyphicon glyphicon-shopping-cart"></i>-->
                        <!--<span>Products</span></a>-->
                        <!--</li> -->
                        <li>
                            <a class="graphics" href="#clip_arts" aria-controls="clip_arts" role="tab" data-toggle="tab"
                               ng-click="deactivateAll()">
                                <i class="fa fa-camera-retro"></i>
                                <span>Art works</span>
                            </a>

                        </li>
                        <li>
                            <a class="graphics" href="#upload_own" aria-controls="upload_own" role="tab"
                               data-toggle="tab"
                               ng-click="deactivateAll()">
                                <i class="fa fa-cloud-upload"></i>
                                <span>Upload own</span>
                            </a>

                        </li>
                        <li>
                            <a class="graphics" href="#qr_code" aria-controls="qr_code" role="tab" data-toggle="tab"
                               ng-click="deactivateAll()">
                                <i class="fa fa-qrcode"></i>
                                <span>Qr code</span>
                            </a>

                        </li>
                        <li>

                            <a class="graphics" href="#hand_draw" aria-controls="hand_draw" role="tab" data-toggle="tab"
                               ng-click="enterDrawing();">
                                <i class="fa fa-pencil-square-o"></i>
                                <span>Hand draw</span>
                            </a>

                        </li>


                        <li>

                            <a class="text" href="#word_cloud" aria-controls="word_cloud" role="tab" data-toggle="tab"
                               ng-click="deactivateAll()">
                                <i class="fa fa-cloud"></i>
                                <span>Word Cloud</span>
                            </a>

                        </li>

                    </ul>
                    <div id="my-tab-content" class="tab-content action_tabs">


                        <div role="tabpanel" class="tab-pane clearfix fade" id="clip_arts">

                            <div class="graphic_types clearfix" ng-show="!graphic_icons">
                                <div ng-repeat="graphicsCategory in graphicsCategories" value="@{{graphicsCategory}}"
                                     ng-click="loadByGraphicsCat(graphicsCategory)" ng-model="graphicsCategory">
                                    <div class="@{{graphicsCategory.split(' ').join('') | lowercase}}"></div>
                                    <span>
                                          @{{graphicsCategory}}
                                        </span>
                                </div>
                            </div>
                            <span ng-show="graphic_icons" class="back_to_graphic" ng-click="ShowGraphicIcons()">
                                    <i class="fa fa-angle-left"></i> Back
                                </span>
                            <div class="graphic_icons" ng-show="graphic_icons">
                                <div class="cal-lg-12 filter_by_cat">
                                    <md-input-container style="">
                                        <label>Sort by category</label>
                                        <md-select ng-model="graphicsCategory" ng-change="loadByGraphicsCategory();">
                                            <md-option ng-repeat="graphicsCategory in graphicsCategories"
                                                       value="@{{graphicsCategory}}">@{{graphicsCategory}}
                                            </md-option>
                                        </md-select>
                                    </md-input-container>
                                </div>
                                <div class="col-lg-12 thumb_listing scrollme" rebuild-on="rebuild:me" ng-scrollbar
                                     is-bar-shown="barShown" ng-class="fabric.selectedObject ? 'activeControls' : ''">
                                    <ul>
                                        <li ng-repeat="graphic in graphics"><a href="javascript:void(0);"
                                                                               ng-click='addShape(graphic)'><img
                                                        data-ng-src="@{{graphic}}" alt="" width="120px;"></a></li>
                                    </ul>
                                    <a ng-if="loadMore" class="loadMore" ng-click="graphics_load_more(graphicsPage)">Load
                                        More</a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane clearfix fade" id="upload_own">
                            <div class="col-lg-12 thumb_listing">
                                <div class="well sideview">
                                    <form name="myForm">
                                        <div class="fileUpload btn btn-primary">
                                            <span>Choose File</span>
                                            <input type="file" ngf-select="onFileSelect(picFile);" ng-model="picFile"
                                                   name="file" accept="image/*" ngf-max-size="2MB" class="upload">
                                        </div>
                                        <input id="uploadFile" placeholdFile NameName disabled="disabled"/>
                                        <span class="has-error"
                                              ng-show="myForm.file.$error.maxSize">File too large @{{picFile.size / 1000000|number:1}}
                                            MB: max 2M</span>
                                        <div class="clearfix"></div>
                                        <span class="has-error" ng-show="myForm.file.$error.maxWidth">File width too large : Max Width 300px</span>
                                        <div class="clearfix"></div>
                                        <span class="has-error" ng-show="myForm.file.$error.maxHeight">File height too large : Max Height 300px</span>
                                        <div class="clearfix"></div>
                                        <span class="has-error" ng-show="uploadErrorMsg">@{{uploadErrorMsg}}</span>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane clearfix fade" id="qr_code">
                            <div class="col-lg-12 thumb_listing">
                                <div class="well sideview">
                                    <div class="row form-group">
                                        <md-input-container flex>
                                            <label>Enter website link or text here</label>
                                            <textarea columns="1" id="textarea-text-qr-code"
                                                      ng-model="fabric.selectedObject.textQRCode"></textarea>
                                        </md-input-container>

                                        <div class="clearfix">
                                            <md-button class="md-raised md-cornered"
                                                       ng-click="addQRCode(fabric.selectedObject.textQRCode);"
                                                       aria-label="Add QR Code"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add
                                                QR
                                                Code
                                            </md-button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane clearfix fade" id="hand_draw">
                            <div class="col-lg-12 thumb_listing">
                                <div class="well sideview">
                                    <div class="row form-group">
                                        <div class="clearfix">
                                            <center>
                                                <md-button class="md-raised md-cornered" ng-click="enterDrawingMode();"
                                                           aria-label="@{{enter_drawing_mode}}"><i
                                                            class="fa fa-plus"></i>&nbsp;&nbsp;@{{enter_drawing_mode}}
                                                </md-button>
                                            </center>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row form-group">
                                        <md-radio-group ng-model="drawing_mode_selector"
                                                        ng-if="enter_drawing_mode == 'Cancel Drawing Mode'">
                                            <md-radio-button value="Pencil" class="md-primary"
                                                             ng-click="changeDrawingMode('Pencil');">Pencil
                                            </md-radio-button>
                                            <md-radio-button value="Circle" class="md-primary"
                                                             ng-click="changeDrawingMode('Circle');"> Circle
                                            </md-radio-button>
                                            <md-radio-button value="Spray" class="md-primary"
                                                             ng-click="changeDrawingMode('Spray');">Spray
                                            </md-radio-button>
                                            <md-radio-button value="Pattern" class="md-primary"
                                                             ng-click="changeDrawingMode('Pattern');">Pattern
                                            </md-radio-button>
                                            <md-radio-button value="hline" class="md-primary"
                                                             ng-click="changeDrawingMode('hline');">H-line
                                            </md-radio-button>
                                            <md-radio-button value="vline" class="md-primary"
                                                             ng-click="changeDrawingMode('vline');">V-line
                                            </md-radio-button>
                                            <md-radio-button value="square" class="md-primary"
                                                             ng-click="changeDrawingMode('square');">Square
                                            </md-radio-button>
                                            <md-radio-button value="diamond" class="md-primary"
                                                             ng-click="changeDrawingMode('diamond');">Diamond
                                            </md-radio-button>
                                        </md-radio-group>

                                    </div>

                                    <br/><br/>
                                    <div class="col-sm-12 input-group colorPicker2"
                                         ng-if="enter_drawing_mode == 'Cancel Drawing Mode'">
                                        <md-input-container flex>
                                            <label for="Line color">Line color:</label>
                                            <input type="text" value="" class="" colorpicker ng-model="drawing_color"
                                                   ng-change="fillDrawing(drawing_color);"/>
                                        </md-input-container>
                                        <span class="input-group-addon"
                                              style="border: medium none #000000; background-color: @{{drawing_color}}"><i></i></span>
                                    </div>

                                    <br/>
                                    <div class="row form-group handtool">
                                        <md-input-container flex ng-if="enter_drawing_mode == 'Cancel Drawing Mode'">
                                            <label for="Line width">Line width:</label>
                                            <input class='col-sm-12' title="Line width" type='range' min="0" max="150"
                                                   step=".01" ng-model="drawing_line_width"
                                                   ng-change="changeDrawingWidth(drawing_line_width);"/>
                                        </md-input-container>
                                    </div>


                                    <div class="row form-group handtool">
                                        <md-input-container flex ng-if="enter_drawing_mode == 'Cancel Drawing Mode'">
                                            <label for="Line shadow">Line shadow:</label>
                                            <input class='col-sm-12' title="Line shadow" type='range' min="0" max="50"
                                                   step=".01" ng-model="drawing_line_shadow"
                                                   ng-change="changeDrawingShadow(drawing_line_shadow);"/>
                                        </md-input-container>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane active clearfix " id="text_design">

                            <div class="col-lg-12 thumb_listing">
                                <div class="well sideview">
                                    <div class="row form-group">
                                        <md-input-container flex>
                                            <label>Enter text below</label>
                                            <textarea columns="1" id="textarea-text"
                                                      style="text-align: @{{ fabric.selectedObject.textAlign }}"
                                                      ng-model="fabric.selectedObject.text"></textarea>
                                        </md-input-container>

                                        <div class="clearfix">
                                            <md-button class="md-raised md-cornered" ng-click="addText()"
                                                       aria-label="Add Text"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add
                                                Text
                                            </md-button>
                                        </div>
                                    </div>

                                </div>
                                <div class="clearfix"></div>

                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane clearfix fade" id="word_cloud">
                            <div class="col-lg-12 thumb_listing">
                                <div class="well sideview">
                                    <div class="row form-group">
                                        <md-input-container flex>
                                            <label>Enter words below</label>
                                            <textarea columns="1" id="textarea-text-word-cloud"
                                                      style="text-align: @{{ fabric.selectedObject.textAlign }}"
                                                      ng-model="fabric.selectedObject.textWordCloud"></textarea>
                                        </md-input-container>
                                        <div class="clearfix">
                                            <md-button class="md-raised md-cornered" ng-click="addWordCloud()"
                                                       aria-label="Add Word Cloud"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add
                                                Word Cloud
                                            </md-button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="tab-pane clearfix" id="Layers">
                            <h1>Layers</h1>
                            <div class="col-lg-12 layer_listing scrollme" rebuild-on="rebuild:layer" ng-scrollbar
                                 is-bar-shown="barShown">

                                <ul class="ul_layer_canvas row">

                                    <li ng-repeat="layer in objectLayers" class="ng-scope">
                                        <span>@{{layer.id}}</span>
                                        <img ng-src="@{{layer.src}}" alt=""/>

                                        <div class="f-right inner">
                                            <ul class="ulInner actions">
                                                <li class="liActions"><a href="javascript:void(0)"
                                                                         ng-click="deleteObject(layer.object);"><i
                                                                class="fa fa-trash"></i></a></li>
                                                <li class="liActions"><a href="javascript:void(0)"
                                                                         ng-click="objectForwardSwap(layer.object);"><i
                                                                class="fa fa-chevron-up"></i></a></li>
                                                <li class="liActions"><a href="javascript:void(0)"
                                                                         ng-click="objectBackwordSwap(layer.object);"><i
                                                                class="fa fa-chevron-down"></i></a></li>
                                                <li class="liActions"><a href="javascript:void(0)"
                                                                         ng-click="lockLayerObject(layer.object);"><i
                                                                class="fa"
                                                                ng-class="isObjectLocked(layer.object) ? 'fa-lock' : 'fa-unlock'"></i></a>
                                                </li>
                                            </ul>
                                        </div>

                                    </li>
                                </ul>

                            </div>
                        </div>

                    </div>
                </div>


                <!---->
                <div class="col-lg-12 sideview-pop" ng-class="fabric.selectedObject ? 'activeControlsElem' : ''"
                     ng-if='fabric.selectedObject.type' ng-switch='fabric.selectedObject.type'>

                    <div class="close-circle"><i class="fa fa-angle-left" ng-click="deactivateAll();"><span>Back</span></i>
                    </div>

                    <div class="well">

                        <div class="row form-group"
                             ng-show="fabric.selectedObject.type == 'text' || fabric.selectedObject.type == 'i-text' || fabric.selectedObject.type == 'curvedText'">
                            <md-input-container flex>
                                <label>Enter text below</label>
                                <textarea columns="1" id="textarea-text"
                                          style="text-align: @{{ fabric.selectedObject.textAlign }}"
                                          ng-model="fabric.selectedObject.text"></textarea>
                            </md-input-container>
                        </div>

                        <div class="row form-group"
                             ng-show="fabric.selectedObject.type == 'i-text' || fabric.selectedObject.type == 'text' ||  fabric.selectedObject.type == 'curvedText'"
                             style="position: relative;">
                            <md-button class="md-raised md-cornered dropdown-toggle" data-toggle="dropdown"
                                       aria-label="Font Family"><span class='object-font-family-preview'
                                                                      style='font-family: "@{{ fabric.selectedObject.fontFamily }}";'> @{{ fabric.selectedObject.fontFamily }} </span>
                                <span class="caret"></span></md-button>

                            <ul class="dropdown-menu">
                                <li ng-repeat='font in FabricConstants.fonts' ng-click='toggleFont(font.name);'
                                    style='font-family: "@{{ font.name }}";'><a>@{{ font.name }}</a></li>
                            </ul>
                        </div>

                        <div class="row row-margin">
                            <div class="row form-group col-lg-6" title="Font size"
                                 ng-show="fabric.selectedObject.type == 'i-text' || fabric.selectedObject.type == 'text' || fabric.selectedObject.type == 'curvedText'">

                                <md-input-container flex>
                                    <label><i class="fa fa-text-height"></i> (Font size)</label>
                                    <input type='number' class="" ng-model="fabric.selectedObject.fontSize"/>
                                </md-input-container>

                            </div>
                            <div class="row form-group col-lg-6" title="Line height"
                                 ng-show="fabric.selectedObject.type == 'i-text' || fabric.selectedObject.type == 'text'">
                                <md-input-container flex>
                                    <label><i class="fa fa-align-left"></i> (Line height)</label>
                                    <input type='number' class="" ng-model="fabric.selectedObject.lineHeight"
                                           step=".1"/>
                                </md-input-container>

                            </div>
                            <div class="row form-group col-lg-6" title="Reverse"
                                 ng-show="fabric.selectedObject.type == 'curvedText'">
                                <md-checkbox ng-model="fabric.selectedObject.isReversed" aria-label="Reverse"
                                             ng-click="toggleReverse(fabric.selectedObject.isReversed);">Reverse
                                </md-checkbox>
                            </div>
                        </div>
                        <div class='row form-group'
                             ng-show="fabric.selectedObject.type == 'i-text' || fabric.selectedObject.type == 'text' || fabric.selectedObject.type == 'curvedText'">
                            <md-button class="md-raised md-cornered"
                                       ng-class="{ active: fabric.selectedObject.textAlign == 'left' }"
                                       ng-click="fabric.selectedObject.textAlign = 'left'" aria-label="Align Left"><i
                                        class='fa fa-align-left'></i></md-button>
                            <md-button class="md-raised md-cornered"
                                       ng-class="{ active: fabric.selectedObject.textAlign == 'center' }"
                                       ng-click="fabric.selectedObject.textAlign = 'center'" aria-label="Align Center">
                                <i
                                        class='fa fa-align-center'></i></md-button>
                            <md-button class="md-raised md-cornered"
                                       ng-class="{ active: fabric.selectedObject.textAlign == 'right' }"
                                       ng-click="fabric.selectedObject.textAlign = 'right'" aria-label="Align Right"><i
                                        class='fa fa-align-right'></i></md-button>
                            <md-button class="md-raised md-cornered" ng-class="{ active: fabric.isBold() }"
                                       ng-click="toggleBold()" aria-label="Bold"><i class='fa fa-bold'></i></md-button>
                            <md-button class="md-raised md-cornered" ng-class="{ active: fabric.isItalic() }"
                                       ng-click="toggleItalic()" aria-label="Italic"><i class='fa fa-italic'></i>
                            </md-button>
                            <md-button class="md-raised md-cornered" ng-class="{ active: fabric.isUnderline() }"
                                       ng-click="toggleUnderline()" aria-label="Underline"><i
                                        class='fa fa-underline'></i>
                            </md-button>
                            <md-button class="md-raised md-cornered" ng-class="{ active: fabric.isLinethrough() }"
                                       ng-click="toggleLinethrough()" aria-label="Strike through"><i
                                        class='fa fa-strikethrough'></i></md-button>
                        </div>

                        <div class='row form-group curved_text'
                             ng-show="fabric.selectedObject.type == 'i-text' || fabric.selectedObject.type == 'text' || fabric.selectedObject.type == 'curvedText'">
                            <md-switch ng-model="fabric.selectedObject.isCurved" aria-label="Switch 1"
                                       ng-change="curveText();">Curved text
                            </md-switch>
                        </div>

                        <div class="row form-group transparency" title="Radius"
                             ng-show="fabric.selectedObject.type == 'curvedText'" style="margin-bottom: 0px;">
                            <md-input-container flex>
                                <label for="Radius">Radius:</label>
                                <input class='col-sm-12' title="Radius" type='range' min="50" max="200" value="100"
                                       ng-model="fabric.selectedObject.radius"
                                       ng-change="radius(fabric.selectedObject.radius);"/>
                            </md-input-container>
                        </div>


                        <div class="row form-group transparency" title="Spacing"
                             ng-show="fabric.selectedObject.type == 'curvedText'" style="margin-bottom: 35px;">
                            <md-input-container flex>
                                <label for="Spacing">Spacing:</label>
                                <input class='col-sm-12' title="Spacing" type='range' min="5" max="30" value="10"
                                       ng-model="fabric.selectedObject.spacing"
                                       ng-change="spacing(fabric.selectedObject.spacing);"/>
                            </md-input-container>
                        </div>

                        <div class="row form-group input-group colorPicker2"
                             ng-show="fabric.selectedObject.type != 'image' && fabric.selectedObject.type != 'path'">
                            <md-input-container flex>
                                <label for="Color">Color:</label>
                                <input type="text" value="" class="" colorpicker ng-model="fabric.selectedObject.fill"
                                       ng-change="fillColor(fabric.selectedObject.fill);"/>
                            </md-input-container>
                            <span class="input-group-addon"
                                  style="border: medium none #000000; background-color: @{{fabric.selectedObject.fill}}"><i></i></span>
                        </div>

                        <div class="row form-group transparency" ng-show="fabric.selectedObject.type != 'curvedText'">
                            <md-input-container flex>
                                <label for="Transparency">Transparency:</label>
                                <input class='col-sm-12' title="Transparency" type='range' min="0" max="1" step=".01"
                                       ng-model="fabric.selectedObject.opacity"
                                       ng-change="opacity(fabric.selectedObject.opacity);"/>
                            </md-input-container>
                        </div>

                        <div class="col-sm-12 input-group cloud-options"
                             ng-show="fabric.selectedObject.type == 'image'">
                            <label class="custom-label">Filters:</label>
                            <br>
                            <md-checkbox ng-model="fabric.selectedObject.isGrayscale" aria-label="Grayscale"
                                         ng-click="setImageFilter(fabric.selectedObject.isGrayscale, 0);">Grayscale
                            </md-checkbox>
                            <md-checkbox ng-model="fabric.selectedObject.isSepia" aria-label="Sepia"
                                         ng-click="setImageFilter(fabric.selectedObject.isSepia, 1);">Sepia
                            </md-checkbox>
                            <md-checkbox ng-model="fabric.selectedObject.isInvert" aria-label="Invert"
                                         ng-click="setImageFilter(fabric.selectedObject.isInvert, 2);">Invert
                            </md-checkbox>
                            <md-checkbox ng-model="fabric.selectedObject.isEmboss" aria-label="Emboss"
                                         ng-click="setImageFilter(fabric.selectedObject.isEmboss, 3);">Emboss
                            </md-checkbox>
                            <md-checkbox ng-model="fabric.selectedObject.isSharpen" aria-label="Sharpen"
                                         ng-click="setImageFilter(fabric.selectedObject.isSharpen, 4);">Sharpen
                            </md-checkbox>
                        </div>

                    </div>


                </div>

                <!---->


            </div>


            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 canvas_section pull-right">
                <div class="row">
                    <div class="canvas_options">
                        <ul class="clearfix">
                            <li ng-click="layers()" href="#Layers" data-toggle="tab"><i
                                        class="fa fa-object-ungroup"></i><span>Layers</span></li>
                            <li ng-click="copyItem()"><i class="fa fa-copy"></i><span>Copy</span></li>
                            <li ng-click="pasteItem()"><i class="fa fa-paste"></i><span>Paste</span></li>
                            <li ng-click="forwardSwap()"><i
                                        class="fa fa-mail-forward"></i><span>Forward <br> Swap</span>
                            </li>
                            <li ng-click="backwordSwap()"><i
                                        class="fa fa-mail-reply"></i><span>Backward <br> Swap</span>
                            </li>
                            <li ng-click="horizontalAlign()"><i
                                        class="fa fa-arrows-h"></i><span>Horizontal <br> Align</span></li>
                            <li ng-click="verticalAlign()"><i class="fa fa-arrows-v"></i><span>Vertical Align</span>
                            </li>
                            <li ng-click="{ active: flipObject() }"><i class="fa fa-exchange fa-2"></i><span>Flip</span>
                            </li>
                            <li ng-click="lockObject()"><i ng-class="isLocked() ? 'fa-lock' : 'fa-unlock'"
                                                           class="fa fa-2"></i><span>Lock Layer</span></li>
                            <li ng-click="removeSelectedObject()"><i
                                        class="fa fa-eraser"></i><span>Remove <br>Layer </span>
                            </li>
                            <li ng-click="clearAll()"><i class="fa fa-trash"></i><span>Empty <br> Canvas</span></li>
                        </ul>
                    </div>
                    <div class="canvas_image image-builder ng-isolate-scope">

                        <div class='fabric-container'>
                            <div class="canvas-container-outer">
                                <canvas fabric='fabric'></canvas>
                            </div>
                            <div class="btn-group-vertical">
                                <div class="icon-vertical m-b-sm pull-right">
                                    <ul>
                                        <li class="saveObject">
                                            <span class="fa fa-save"></span>

                                            <ul class="ulChildMenu">
                                                <li class="childLi">
                                                    <a ng-click="saveObjectAsSvg()" href="javascript:void(0);"
                                                       class="ng-scope">Save as SVG</a>
                                                </li>
                                                <li class="childLi">
                                                    <a ng-click="saveObjectAsPng()" href="javascript:void(0);"
                                                       class="ng-scope">Save as PNG</a>
                                                </li>
                                                <li class="childLi">
                                                    <a ng-click="saveObjectAsJpg()" href="javascript:void(0);"
                                                       class="ng-scope">Save as JPG</a>
                                                </li>
                                                <li class="childLi">
                                                    <a ng-click="downloadObjectAsPdf()" href="javascript:void(0);"
                                                       class="ng-scope">Download as PDF</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a ng-click="printObject()" href="javascript:void(0);"
                                               class="ng-scope"><span
                                                        class="fa fa-print"></span></a>
                                            <md-tooltip md-visible="print.showTooltip" md-direction="left">Print
                                            </md-tooltip>
                                        </li>

                                        <li>
                                            <a ng-click="downloadObject()" href="javascript:void(0);"
                                               class="ng-scope"><span
                                                        class="fa fa-cloud-download"></span></a>
                                            <md-tooltip md-visible="download.showTooltip" md-direction="left">Download
                                                as
                                                PNG
                                            </md-tooltip>
                                        </li>

                                        <li class="">
                                            <a class="fa fa-search-plus ng-scope ng-isolate-scope" translate=""
                                               ng-click="zoomObject('zoomin')" href="javascript:void(0);"><span
                                                        class="ng-binding ng-scope"></span></a>
                                            <md-tooltip md-visible="zoomin.showTooltip" md-direction="left">Select
                                                object
                                                and Zoom In
                                            </md-tooltip>
                                        </li>
                                        <li>
                                            <a class="fa fa-search-minus ng-scope ng-isolate-scope" translate=""
                                               ng-click="zoomObject('zoomout')" href="javascript:void(0);"><span
                                                        class="ng-binding ng-scope"></span></a>
                                            <md-tooltip md-visible="zoomout.showTooltip" md-direction="left">Select
                                                object
                                                and Zoom Out
                                            </md-tooltip>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <a class="fa fa-undo ng-scope ng-isolate-scope" translate=""
                                               ng-click="undo()"
                                               href="javascript:void(0);"><span class="ng-binding ng-scope"></span></a>
                                            <md-tooltip md-visible="undo.showTooltip" md-direction="left">Undo
                                            </md-tooltip>
                                        </li>
                                        <li>
                                            <a class="fa fa-repeat ng-scope ng-isolate-scope" translate=""
                                               ng-click="redo()"
                                               href="javascript:void(0);"><span class="ng-binding ng-scope"></span></a>
                                            <md-tooltip md-visible="redo.showTooltip" md-direction="left">Redo
                                            </md-tooltip>
                                        </li>
                                    </ul>
                                </div>
                                <div class="social-share">
                                    <a href="javascript:void(0);" id="f_share_button" class="fa fa-facebook"
                                       ng-click="shareOnFacebook($event);"></a> <a href="javascript:void(0)"
                                                                                   class="fa fa-twitter"
                                                                                   ng-click="shareOnTwitter($event);"></a>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="canvas_sub_image">
                        <ul>
                            <li ng-repeat="prodImg in productImages">
                                <img ng-click='loadProduct(defaultProductTitle, prodImg, defaultProductId, defaultPrice, defaultCurrency, $index)'
                                     data-ng-src="@{{prodImg}}" alt="" width="120px;">
                            </li>
                        </ul>
                    </div>
                    <div class="canvas_details clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <span class="product_name">@{{defaultProductTitle}}</span>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 clearfix">
                            <span class="pull-left">Qty:</span>
                            <div class="m-prod_detail_attr">
                                <div class="pull-left m-prod_counter">
                                    <span ng-click="increments()"><i class="fa fa-plus"></i></span>
                                    <span ng-click="decrement()"><i class="fa fa-minus"></i></span>
                                    <input type="text" value="@{{counter}}" id="m-prod_count" name="quantity" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6 clearfix pricing">
                            <span class="price_title">Price</span>
                            <span class="price_amnt">@{{defaultPrice}} @{{defaultCurrency}}</span>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                            <a class="cart_icon" href="javascript:void(0)" ng-click="addToCart()">
                                <i class="fa fa-shopping-cart"></i>
                                Add to cart
                            </a>
                        </div>
                    </div>

                </div>

            </div>


            <section class="customizer" id="customizer">
                <a href="http://designtailor.veepixel.com/"><img src="/emailedit/images/logo.png" alt="" class="logo"></a>
                <div class="selector">
                    <h2>Live Customizer</h2>
                    <div class="color_section color_block">


                        <span class="customizer_headings">Color Changer</span>

                        <div class="col-lg-12 color-mixer">
                            <div class="col-lg-12">
                                <label class="customizer-label">Primary</label>
                                <div class="input-group colorPicker2 colorpicker-element">
                                    <input ng-model="primaryColor" colorpicker type="text" value=""
                                           class="form-control"/>
                                    <span class="input-group-addon"><i style="background: @{{primaryColor}};"></i></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="customizer-label">Secondary</label>
                                <div class="input-group colorPicker2 colorpicker-element">
                                    <input ng-model="secondaryColor" colorpicker type="text" value=""
                                           class="form-control"/>
                                    <span class="input-group-addon"><i
                                                style="background: @{{secondaryColor}};"></i></span>
                                </div>
                            </div>
                            <hr/>
                            <br/><br/>
                            <div class="col-lg-12">
                                <center><input ng-model="colorResult" type="button" value="Apply Color Scheme"
                                               class="btn btn-info" ng-click="changeColorScheme()"/></center>
                            </div>

                        </div>

                        <span class="customizer_headings">Canvas Background</span>
                        <ul id="canvas_color_selector" class="color_selector canvas_selector">
                            <li data-attr="images/site_bg_01.jpg" class="canvas_1"></li>
                            <li data-attr="images/site_bg_02.jpg" class="canvas_2"></li>
                            <li data-attr="images/site_bg_03.jpg" class="canvas_3"></li>
                            <li data-attr="images/site_bg_04.jpg" class="canvas_4"></li>
                        </ul>
                        <span class="customizer_headings">Page Layout</span>
                        <ul class="layout_options">
                            <li><a href="index.html"><img src="/emailedit/images/layout_2.jpg" style="width: 60px;"></a></li>
                            <li><a href="index_01.html"><img src="/emailedit/images/layout_1.jpg" style="width: 60px;"></a></li>
                            <li><a href="index_02.html"><img src="/emailedit/images/layout_3.jpg" style="width: 60px;"></a></li>
                        </ul>
                    </div>
                </div>
                {{--<i class="fa fa-cog" id="selector_icon"></i>--}}
            </section>
        </div>
    </div>
    {{--@include ('footer')--}}

    <script>
        var template = '{!! $template !!}';

    </script>
    <script src="/emailedit/assets/angular.js"></script>

    <script src="/emailedit/assets/angular-animate.js"></script>
    <script src="/emailedit/assets/angular-aria.js"></script>

    <script src="/emailedit/assets/angular-material.js"></script>

    <script src="/emailedit/assets/ng-file-upload/angular-file-upload.js"></script>
    <script src="/emailedit/assets/ng-file-upload/angular-file-upload-shim.js"></script>

    <script type="text/javascript" src="/emailedit/assets/qr-code/raphael-2.1.0-min.js"></script>
    <script type="text/javascript" src="/emailedit/assets/qr-code/qrcodesvg.js"></script>

    <script src='/emailedit/assets/word-cloud/d3.v3.min.js'></script>
    <script src='/emailedit/assets/word-cloud/d3.layout.cloud.js'></script>

    <script src="/emailedit/assets/angular-sanitize.min.js"></script>
    <script src="/emailedit/assets/ng-scrollbar.min.js"></script>

    <script src="/emailedit/assets/fabric/fabric.js"></script>
    <script src="/emailedit/assets/fabric/fabric.min.js"></script>
    <script src="/emailedit/assets/fabric/fabricCanvas.js"></script>
    <script src="/emailedit/assets/fabric/fabricConstants.js"></script>
    <script src="/emailedit/assets/fabric/fabricDirective.js"></script>
    <script src="/emailedit/assets/fabric/fabricDirtyStatus.js"></script>
    <script src="/emailedit/assets/fabric/fabricUtilities.js"></script>
    <script src="/emailedit/assets/fabric/fabricWindow.js"></script>
    <script src="/emailedit/assets/fabric/fabric.curvedText.js"></script>
    <script src="/emailedit/assets/fabric/fabric.customiseControls.js"></script>

    <script src="/emailedit/assets/colorpicker/bootstrap-colorpicker-module.js"></script>
    <script src="/emailedit/js/application.js"></script>

    <script src="/emailedit/assets/file/fileSaver.js"></script>
    <script src="/emailedit/assets/pdf/jspdf.debug.js"></script>

    <div id="qrcode"></div>
    <div id="wordcloud"></div>
    <div class="css_gen"></div>
    <div class="svgElements"></div>
</body>
</html>
