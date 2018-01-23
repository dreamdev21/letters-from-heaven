/*!
 * http://suyati.github.io/line-control
 * LineControl 1.1.0
 * Copyright (C) 2014, Suyati Technologies
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with this library; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 *
*/

(function ($) {
    var editorObj;
    var methods = {
        saveSelection: function () {
            //Function to save the text selection range from the editor
            $(this).data('editor').focus();
            if (window.getSelection) {
                sel = window.getSelection();
                if (sel.getRangeAt && sel.rangeCount) {
                    $(this).data('currentRange', sel.getRangeAt(0));
                }
            } else if (document.selection && document.selection.createRange) {
                $(this).data('currentRange', document.selection.createRange());
            }
            else
                $(this).data('currentRange', null);
        },

        restoreSelection: function (text, mode) {
            //Function to restore the text selection range from the editor
            var node;
            typeof text !== 'undefined' ? text : false;
            typeof mode !== 'undefined' ? mode : "";
            var range = $(this).data('currentRange');
            if (range) {
                if (window.getSelection) {
                    if (text) {
                        range.deleteContents();
                        if (mode == "html") {
                            var el = document.createElement("div");
                            el.innerHTML = text;
                            var frag = document.createDocumentFragment(), node, lastNode;
                            while ((node = el.firstChild)) {
                                lastNode = frag.appendChild(node);
                            }
                            range.insertNode(frag);
                        }
                        else
                            range.insertNode(document.createTextNode(text));

                    }
                    sel = window.getSelection();
                    sel.removeAllRanges();
                    sel.addRange(range);
                }
                else if (document.selection && range.select) {
                    range.select();
                    if (text) {
                        if (mode == "html")
                            range.pasteHTML(text);
                        else
                            range.text = text;
                    }
                }
            }
        },

        restoreIESelection: function () {
            //Function to restore the text selection range from the editor in IE
            var range = $(this).data('currentRange');
            if (range) {
                if (window.getSelection) {
                    sel = window.getSelection();
                    sel.removeAllRanges();
                    sel.addRange(range);
                } else if (document.selection && range.select) {
                    range.select();
                }
            }
        },

        insertTextAtSelection: function (text, mode) {
            var sel, range, node;
            typeof mode !== 'undefined' ? mode : "";
            if (window.getSelection) {
                sel = window.getSelection();
                if (sel.getRangeAt && sel.rangeCount) {
                    range = sel.getRangeAt(0);
                    range.deleteContents();
                    var textNode = document.createTextNode(text);

                    if (mode == "html") {
                        var el = document.createElement("div");
                        el.innerHTML = text;
                        var frag = document.createDocumentFragment(), node, lastNode;
                        while ((node = el.firstChild)) {
                            lastNode = frag.appendChild(node);
                        }
                        range.insertNode(frag);
                    }
                    else {
                        range.insertNode(textNode);
                        range.selectNode(textNode);
                    }
                    sel.removeAllRanges();
                    range = range.cloneRange();
                    range.collapse(false);
                    sel.addRange(range);
                }
            } else if (document.selection && document.selection.createRange) {
                range = document.selection.createRange();
                range.pasteHTML(text);
                range.select();
            }
        },

        imageWidget: function () {
            //Class for Widget Handling the upload of Files
            var row = $('<div/>', {
                "class": "row"
            }).append($('<div/>', {
                id: "imgErrMsg"
            }));
            var container = $('<div/>', {'class': "tabbable tabs-left"});
            var navTabs = $('<ul/>',
                {
                    class: "nav nav-tabs"
                }).append($('<li/>',
                {
                    class: "active"
                }).append($('<a/>', {
                    "href": "#uploadImageBar",
                    "data-toggle": "tab"
                }).html("From Computer")
            )).append($('<li/>').append($('<a/>', {
                "href": "#imageFromLinkBar",
                "data-toggle": "tab"
            }).html("From URL")));

            var tabContent = $("<div/>", {class: "tab-content"});
            var uploadImageBar = $("<div/>", {
                id: "uploadImageBar",
                class: "tab-pane active"
            });

            handleFileSelect = function (evt) {
                var files = evt.target.files; // FileList object
                var output = [];
                for (var i = 0, f; f = files[i]; i++) {
                    //Loop thorugh all the files
                    if (!f.type.match('image.*') || !f.name.match(/(?:gif|jpg|png|jpeg)$/)) { //Process only Images
                        methods.showMessage.apply(this, ["imgErrMsg", "Invalid file type"]);
                        continue;
                    }
                    var reader = new FileReader();
                    reader.onload = (function (imageFile) {
                        return function (e) {
                            //Render Thumnails
                            var li = $('<li/>', {class: "col-xs-12 col-sm-6 col-md-3 col-lg-3"});
                            var a = $('<a/>', {
                                href: "javascript:void(0)",
                                class: "thumbnail"
                            });
                            var image = $('<img/>', {
                                src: e.target.result,
                                title: escape(imageFile.name)
                            }).appendTo(a).click(function () {
                                $('#imageList').data('current', $(this).attr('src'));
                            });
                            li.append(a).appendTo($('#imageList'));
                        }
                    })(f);
                    reader.readAsDataURL(f);
                }
            }
            var chooseFromLocal = $('<input/>', {
                type: "file",
                class: "inline-form-control",
                multiple: "multiple"
            });
            chooseFromLocal.on('change', handleFileSelect);
            uploadImageBar.append(chooseFromLocal);
            var imageFromLinkBar = $("<div/>", {
                id: "imageFromLinkBar",
                class: "tab-pane"
            });
            var getImageURL = $("<div/>", {class: "input-group"});
            var imageURL = $('<input/>', {
                type: "url",
                class: 'form-control',
                id: "imageURL",
                placeholder: "Enter URL"
            }).appendTo(getImageURL);
            var getURL = $("<button/>", {
                class: "btn btn-success",
                type: "button"
            }).html("Go!").click(function () {
                var url = $('#imageURL').val();
                if (url == '') {
                    methods.showMessage.apply(this, ["imgErrMsg", "Please enter image url"]);
                    return false;
                }
                var li = $('<li/>', {class: "span6 col-xs-12 col-sm-6 col-md-3 col-lg-3"});
                var a = $('<a/>', {
                    href: "javascript:void(0)",
                    class: "thumbnail"
                });
                var image = $('<img/>', {
                    src: url,
                }).error(function () {
                    methods.showMessage.apply(this, ["imgErrMsg", "Invalid image url"]);
                    return false;
                }).load(function () {
                    $(this).appendTo(a).click(function () {
                        $('#imageList').data('current', $(this).attr('src'));
                    });
                    li.append(a).appendTo($('#imageList'));
                });
            }).appendTo($("<span/>", {class: "input-group-btn form-control-button-right"}).appendTo(getImageURL));

            imageFromLinkBar.append(getImageURL);
            tabContent.append(uploadImageBar).append(imageFromLinkBar);
            container.append(navTabs).append(tabContent);

            var imageListContainer = $("<div/>", {'class': 'col-xs-12 col-sm-12 col-md-12 col-lg-12'});
            var imageList = $('<ul/>', {
                "class": "thumbnails padding-top list-unstyled",
                "id": 'imageList'
            }).appendTo(imageListContainer);
            row.append(container).append(imageListContainer);
            return row;
        },

        tableWidget: function (mode) {
            //Function to generate the table input form
            var idExtn = '';
            if (typeof mode !== 'undefined')
                idExtn = "Edt";

            var tblCntr = $('<div/>', { //Outer Container Div
                class: "row-fluid"
            }).append($('<div/>', { //Err Message Div
                id: "tblErrMsg" + idExtn
            })).append($('<form/>', { //Form
                    id: "tblForm" + idExtn
                }).append($('<div/>', { //Inner Container Div
                    class: "row"
                }).append($('<div/>', { //Left input Container Div
                    id: "tblInputsLeft" + idExtn,
                    class: "col-xs-12 col-sm-6 col-md-6 col-lg-6"
                }).append($('<label/>', {for: "tblRows" + idExtn, text: "Rows"}
                )).append($('<input/>', {
                    id: "tblRows" + idExtn,
                    type: "text",
                    class: "form-control form-control-width",
                    value: 2
                })).append($('<label/>', {for: "tblColumns" + idExtn, text: "Columns"}
                )).append($('<input/>', {
                    id: "tblColumns" + idExtn,
                    type: "text",
                    class: "form-control form-control-width",
                    value: 2
                })).append($('<label/>', {for: "tblWidth" + idExtn, text: "Width"}
                )).append($('<input/>', {
                    id: "tblWidth" + idExtn,
                    type: "text",
                    class: "form-control form-control-width",
                    value: 400
                })).append($('<label/>', {for: "tblHeight" + idExtn, text: "Height"}
                )).append($('<input/>', {
                    id: "tblHeight" + idExtn,
                    type: "text",
                    class: "form-control form-control-width",
                }))
                ).append($('<div/>', { //Right input Container Div
                    id: "tblInputsRight" + idExtn,
                    class: "col-xs-12 col-sm-6 col-md-6 col-lg-6"
                }).append($('<label/>', {for: "tblAlign" + idExtn, text: "Alignment"}
                )).append($('<select/>', {id: "tblAlign" + idExtn, class: "form-control form-control-width"}
                ).append($('<option/>', {text: "Choose", value: ""}
                )).append($('<option/>', {text: "Left", value: "left"}
                )).append($('<option/>', {text: "Center", value: "center"}
                )).append($('<option/>', {text: "Right", value: "right"}))
                ).append($('<label/>', {for: "tblBorder" + idExtn, text: "Border size"}
                )).append($('<input/>', {
                    id: "tblBorder" + idExtn,
                    type: "text",
                    class: "form-control form-control-width",
                    value: 1
                })).append($('<label/>', {for: "tblCellspacing" + idExtn, text: "Cell spacing"}
                )).append($('<input/>', {
                    id: "tblCellspacing" + idExtn,
                    type: "text",
                    class: "form-control form-control-width",
                    value: 1
                })).append($('<label/>', {for: "tblCellpadding" + idExtn, text: "Cell padding"}
                )).append($('<input/>', {
                    id: "tblCellpadding" + idExtn,
                    type: "text",
                    class: "form-control form-control-width",
                    value: 1
                }))
                )
                )
            )
            return tblCntr;
        },

        imageAttributeWidget: function () {

            var edtTablecntr = $('<div/>', {
                    class: "row-fluid"
                }
            ).append($('<div/>', { //Err Message Div
                id: "imageErrMsg"
            })).append($('<input/>', {
                id: "imgAlt",
                type: "text",
                class: "form-control form-control-link ",
                placeholder: "Alt Text",
            })).append($('<input/>', {
                id: "imgTarget",
                class: "form-control form-control-link ",
                type: "text",
                placeholder: "Link Target"
            })).append($('<input/>', {
                id: "imgHidden",
                type: "hidden"
            }))

            return edtTablecntr;

        },

        getHTMLTable: function (tblRows, tblColumns, attributes) {
            //Function to generate html table. Supplied arguments: tablerows-no.of rows, no.of columns, table attributes.
            var tableElement = $('<table/>', {class: "table"});
            for (var i = 0; i < attributes.length; i++) {
                if (attributes[i].value != '') {
                    if (attributes[i].attribute == "width" || attributes[i].attribute == "height")
                        tableElement.css(attributes[i].attribute, attributes[i].value);
                    else
                        tableElement.attr(attributes[i].attribute, attributes[i].value);
                }
            }
            for (var i = 1; i <= tblRows; i++) {
                var tblRow = $('<tr/>');
                for (var j = 1; j <= tblColumns; j++) {
                    var tblColumn = $('<td/>').html('&nbsp;');
                    tblColumn.appendTo(tblRow);
                }
                tblRow.appendTo(tableElement);
            }
            return tableElement;
        },

        init: function (options) {
            var fonts = {
                "Sans serif": "arial,helvetica,sans-serif",
                "Serif": "times new roman,serif",
                "Wide": "arial black,sans-serif",
                "Narrow": "arial narrow,sans-serif",
                "Comic Sans MS": "comic sans ms,sans-serif",
                "Courier New": "courier new,monospace",
                "Garamond": "garamond,serif",
                "Georgia": "georgia,serif",
                "Tahoma": "tahoma,sans-serif",
                "Trebuchet MS": "trebuchet ms,sans-serif",
                "Verdana": "verdana,sans-serif"
            };

            var styles = {
                "Heading 1": "<h1>",
                "Heading 2": "<h2>",
                "Heading 3": "<h3>",
                "Heading 4": "<h4>",
                "Heading 5": "<h5>",
                "Heading 6": "<h6>",
                "Paragraph": "<p>"
            };

            var fontsizes = {
                "Small": "2",
                "Normal": "3",
                "Medium": "4",
                "Large": "5",
                "Huge": "6"
            };

            var colors = [{name: 'Black', hex: '#000000'},
                {name: 'MediumBlack', hex: '#444444'},
                {name: 'LightBlack', hex: '#666666'},
                {name: 'DimBlack', hex: '#999999'},
                {name: 'Gray', hex: '#CCCCCC'},
                {name: 'DimGray', hex: '#EEEEEE'},
                {name: 'LightGray', hex: '#F3F3F3'},
                {name: 'White', hex: '#FFFFFF'},

                {name: 'libreak', hex: null},

                {name: 'Red', hex: '#FF0000'},
                {name: 'Orange', hex: '#FF9900'},
                {name: 'Yellow', hex: '#FFFF00'},
                {name: 'Lime', hex: '#00FF00'},
                {name: 'Cyan', hex: '#00FFFF'},
                {name: 'Blue', hex: '#0000FF'},
                {name: 'BlueViolet', hex: '#8A2BE2'},
                {name: 'Magenta', hex: '#FF00FF'},

                {name: 'libreak', hex: null},

                {name: 'LightPink', hex: '#FFB6C1'},
                {name: 'Bisque', hex: '#FCE5CD'},
                {name: 'BlanchedAlmond', hex: '#FFF2CC'},
                {name: 'LightLime', hex: '#D9EAD3'},
                {name: 'LightCyan', hex: '#D0E0E3'},
                {name: 'AliceBlue', hex: '#CFE2F3'},
                {name: 'Lavender', hex: '#D9D2E9'},
                {name: 'Thistle', hex: '#EAD1DC'},

                {name: 'LightCoral', hex: '#EA9999'},
                {name: 'Wheat', hex: '#F9CB9C'},
                {name: 'NavajoWhite', hex: '#FFE599'},
                {name: 'DarkSeaGreen', hex: '#B6D7A8'},
                {name: 'LightBlue', hex: '#A2C4C9'},
                {name: 'SkyBlue', hex: '#9FC5E8'},
                {name: 'LightPurple', hex: '#B4A7D6'},
                {name: 'PaleVioletRed', hex: '#D5A6BD'},

                {name: 'IndianRed', hex: '#E06666'},
                {name: 'LightSandyBrown', hex: '#F6B26B'},
                {name: 'Khaki', hex: '#FFD966'},
                {name: 'YellowGreen', hex: '#93C47D'},
                {name: 'CadetBlue', hex: '#76A5AF'},
                {name: 'DeepSkyBlue', hex: '#6FA8DC'},
                {name: 'MediumPurple', hex: '#8E7CC3'},
                {name: 'MediumVioletRed', hex: '#C27BA0'},

                {name: 'Crimson', hex: '#CC0000'},
                {name: 'SandyBrown', hex: '#E69138'},
                {name: 'Gold', hex: '#F1C232'},
                {name: 'MediumSeaGreen', hex: '#6AA84F'},
                {name: 'Teal', hex: '#45818E'},
                {name: 'SteelBlue', hex: '#3D85C6'},
                {name: 'SlateBlue', hex: '#674EA7'},
                {name: 'VioletRed', hex: '#A64D79'},

                {name: 'Brown', hex: '#990000'},
                {name: 'Chocolate', hex: '#B45F06'},
                {name: 'GoldenRod', hex: '#BF9000'},
                {name: 'Green', hex: '#38761D'},
                {name: 'SlateGray', hex: '#134F5C'},
                {name: 'RoyalBlue', hex: '#0B5394'},
                {name: 'Indigo', hex: '#351C75'},
                {name: 'Maroon', hex: '#741B47'},

                {name: 'DarkRed', hex: '#660000'},
                {name: 'SaddleBrown', hex: '#783F04'},
                {name: 'DarkGoldenRod', hex: '#7F6000'},
                {name: 'DarkGreen', hex: '#274E13'},
                {name: 'DarkSlateGray', hex: '#0C343D'},
                {name: 'Navy', hex: '#073763'},
                {name: 'MidnightBlue', hex: '#20124D'},
                {name: 'DarkMaroon', hex: '#4C1130'}];

            var specialchars = [
                // {name: "Exclamation ", text: "!"},
                // {name: "At", text: "😀"},
                // {name: "Hash", text: "😃"},
                // {name: "Percentage", text: "😄"},
                // {name: "Uppercase", text: "😁"},
                // {name: "Ampersand", text: "😆"},
                // {name: "Asterisk", text: "😅"},
                // {name: "OpenBracket", text: "😂"},
                // {name: "CloseBracket", text: "😊"},
                // {name: "Underscore", text: "🙂"},
                // {name: "Hiphen", text: "🙃"},
                // {name: "Plus", text: "😉"},
                // {name: "Equalto", text: "😌"},
                // {name: "OpenSquareBracket", text: "😍"},
                // {name: "CloseSquareBracket", text: "😘"},
                // {name: "OpenCurly", text: "😗"},
                // {name: "CloseCurly", text: "😋"},
                // {name: "Pipe", text: "😜"},
                // {name: "Colon", text: "😝"},
                // {name: "Semicolon", text: "😎"},
                // {name: "Single quote", text: "😏;"},
                // {name: "Double quote", text: "&#34;"},
                // {name: "Left single curly quote", text: "&lsquo;"},
                // {name: "right single curly quote", text: "&rsquo;"},
                // {name: "Forward-slash", text: "&#47;"},
                // {name: "Back-slash", text: "&#92;"},
                // {name: "LessThan", text: "<"},
                // {name: "GreaterThan", text: ">"},
                // {name: "QuestionMark", text: "?"},
                // {name: "Tilda", text: "~"},
                // {name: "Grave accent", text: "`"},
                // {name: "Micron", text: "&micro;"},
                // {name: "Paragraph sign", text: "&para;"},
                // {name: "Plus/minus", text: "&plusmn;"},
                // {name: "Trademark", text: "&trade;"},
                // {name: "Copyright", text: "&copy;"},
                // {name: "Registered", text: "&reg;"},
                // {name: "Section", text: "&sect;"},
                // {name: "right double angle quotes", text: "&#187;"},
                // {name: "fraction one quarter", text: "&#188;"},
                // {name: "fraction one half", text: "&#189;"},
                // {name: "fraction three quarters", text: "&#190;"},
                // {name: "Dollar", text: "$"},
                // {name: "Euro", text: "&euro;"},
                // {name: "Pound", text: "&pound;"},
                // {name: "Yen", text: "&yen;"},
                // {name: "Cent", text: "&#162;"},
                // {name: "IndianRupee", text: "&#8377;"},
                 {
                    "emoji": "😄"
                    , "description": "smiling face with open mouth & smiling eyes"
                    , "category": "People"
                    , "aliases": [
                        "smile"
                    ]
                    , "tags": [
                        "happy"
                        , "joy"
                        , "laugh"
                        , "pleased"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🌸"
                    , "description": "grinning face with smiling eyes"
                    , "category": "People"
                    , "aliases": [
                        "grin"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😆"
                    , "description": "smiling face with open mouth & closed eyes"
                    , "category": "People"
                    , "aliases": [
                        "laughing"
                        , "satisfied"
                    ]
                    , "tags": [
                        "happy"
                        , "haha"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😅"
                    , "description": "smiling face with open mouth & cold sweat"
                    , "category": "People"
                    , "aliases": [
                        "sweat_smile"
                    ]
                    , "tags": [
                        "hot"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😂"
                    , "description": "face with tears of joy"
                    , "category": "People"
                    , "aliases": [
                        "joy"
                    ]
                    , "tags": [
                        "tears"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🤣"
                    , "description": "rolling on the floor laughing"
                    , "category": "People"
                    , "aliases": [
                        "rofl"
                    ]
                    , "tags": [
                        "lol"
                        , "laughing"
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "☺️"
                    , "description": "smiling face"
                    , "category": "People"
                    , "aliases": [
                        "relaxed"
                    ]
                    , "tags": [
                        "blush"
                        , "pleased"
                    ]
                    , "unicode_version": ""
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😊"
                    , "description": "smiling face with smiling eyes"
                    , "category": "People"
                    , "aliases": [
                        "blush"
                    ]
                    , "tags": [
                        "proud"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😇"
                    , "description": "smiling face with halo"
                    , "category": "People"
                    , "aliases": [
                        "innocent"
                    ]
                    , "tags": [
                        "angel"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🙂"
                    , "description": "slightly smiling face"
                    , "category": "People"
                    , "aliases": [
                        "slightly_smiling_face"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "7.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "🙃"
                    , "description": "upside-down face"
                    , "category": "People"
                    , "aliases": [
                        "upside_down_face"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "8.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "😉"
                    , "description": "winking face"
                    , "category": "People"
                    , "aliases": [
                        "wink"
                    ]
                    , "tags": [
                        "flirt"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😌"
                    , "description": "relieved face"
                    , "category": "People"
                    , "aliases": [
                        "relieved"
                    ]
                    , "tags": [
                        "whew"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😍"
                    , "description": "smiling face with heart-eyes"
                    , "category": "People"
                    , "aliases": [
                        "heart_eyes"
                    ]
                    , "tags": [
                        "love"
                        , "crush"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😘"
                    , "description": "face blowing a kiss"
                    , "category": "People"
                    , "aliases": [
                        "kissing_heart"
                    ]
                    , "tags": [
                        "flirt"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😗"
                    , "description": "kissing face"
                    , "category": "People"
                    , "aliases": [
                        "kissing"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.1"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😙"
                    , "description": "kissing face with smiling eyes"
                    , "category": "People"
                    , "aliases": [
                        "kissing_smiling_eyes"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.1"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😚"
                    , "description": "kissing face with closed eyes"
                    , "category": "People"
                    , "aliases": [
                        "kissing_closed_eyes"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😋"
                    , "description": "face savouring delicious food"
                    , "category": "People"
                    , "aliases": [
                        "yum"
                    ]
                    , "tags": [
                        "tongue"
                        , "lick"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😜"
                    , "description": "face with stuck-out tongue & winking eye"
                    , "category": "People"
                    , "aliases": [
                        "stuck_out_tongue_winking_eye"
                    ]
                    , "tags": [
                        "prank"
                        , "silly"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😝"
                    , "description": "face with stuck-out tongue & closed eyes"
                    , "category": "People"
                    , "aliases": [
                        "stuck_out_tongue_closed_eyes"
                    ]
                    , "tags": [
                        "prank"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😛"
                    , "description": "face with stuck-out tongue"
                    , "category": "People"
                    , "aliases": [
                        "stuck_out_tongue"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.1"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🤑"
                    , "description": "money-mouth face"
                    , "category": "People"
                    , "aliases": [
                        "money_mouth_face"
                    ]
                    , "tags": [
                        "rich"
                    ]
                    , "unicode_version": "8.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "🤗"
                    , "description": "hugging face"
                    , "category": "People"
                    , "aliases": [
                        "hugs"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "8.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "🤓"
                    , "description": "nerd face"
                    , "category": "People"
                    , "aliases": [
                        "nerd_face"
                    ]
                    , "tags": [
                        "geek"
                        , "glasses"
                    ]
                    , "unicode_version": "8.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "😎"
                    , "description": "smiling face with sunglasses"
                    , "category": "People"
                    , "aliases": [
                        "sunglasses"
                    ]
                    , "tags": [
                        "cool"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🤡"
                    , "description": "clown face"
                    , "category": "People"
                    , "aliases": [
                        "clown_face"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "🤠"
                    , "description": "cowboy hat face"
                    , "category": "People"
                    , "aliases": [
                        "cowboy_hat_face"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "😏"
                    , "description": "smirking face"
                    , "category": "People"
                    , "aliases": [
                        "smirk"
                    ]
                    , "tags": [
                        "smug"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😒"
                    , "description": "unamused face"
                    , "category": "People"
                    , "aliases": [
                        "unamused"
                    ]
                    , "tags": [
                        "meh"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😞"
                    , "description": "disappointed face"
                    , "category": "People"
                    , "aliases": [
                        "disappointed"
                    ]
                    , "tags": [
                        "sad"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😔"
                    , "description": "pensive face"
                    , "category": "People"
                    , "aliases": [
                        "pensive"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😟"
                    , "description": "worried face"
                    , "category": "People"
                    , "aliases": [
                        "worried"
                    ]
                    , "tags": [
                        "nervous"
                    ]
                    , "unicode_version": "6.1"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😕"
                    , "description": "confused face"
                    , "category": "People"
                    , "aliases": [
                        "confused"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.1"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🙁"
                    , "description": "slightly frowning face"
                    , "category": "People"
                    , "aliases": [
                        "slightly_frowning_face"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "7.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "☹️"
                    , "description": "frowning face"
                    , "category": "People"
                    , "aliases": [
                        "frowning_face"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": ""
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "😣"
                    , "description": "persevering face"
                    , "category": "People"
                    , "aliases": [
                        "persevere"
                    ]
                    , "tags": [
                        "struggling"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😖"
                    , "description": "confounded face"
                    , "category": "People"
                    , "aliases": [
                        "confounded"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😫"
                    , "description": "tired face"
                    , "category": "People"
                    , "aliases": [
                        "tired_face"
                    ]
                    , "tags": [
                        "upset"
                        , "whine"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😩"
                    , "description": "weary face"
                    , "category": "People"
                    , "aliases": [
                        "weary"
                    ]
                    , "tags": [
                        "tired"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😤"
                    , "description": "face with steam from nose"
                    , "category": "People"
                    , "aliases": [
                        "triumph"
                    ]
                    , "tags": [
                        "smug"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😠"
                    , "description": "angry face"
                    , "category": "People"
                    , "aliases": [
                        "angry"
                    ]
                    , "tags": [
                        "mad"
                        , "annoyed"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😡"
                    , "description": "pouting face"
                    , "category": "People"
                    , "aliases": [
                        "rage"
                        , "pout"
                    ]
                    , "tags": [
                        "angry"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😶"
                    , "description": "face without mouth"
                    , "category": "People"
                    , "aliases": [
                        "no_mouth"
                    ]
                    , "tags": [
                        "mute"
                        , "silence"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😐"
                    , "description": "neutral face"
                    , "category": "People"
                    , "aliases": [
                        "neutral_face"
                    ]
                    , "tags": [
                        "meh"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😑"
                    , "description": "expressionless face"
                    , "category": "People"
                    , "aliases": [
                        "expressionless"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.1"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😯"
                    , "description": "hushed face"
                    , "category": "People"
                    , "aliases": [
                        "hushed"
                    ]
                    , "tags": [
                        "silence"
                        , "speechless"
                    ]
                    , "unicode_version": "6.1"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😦"
                    , "description": "frowning face with open mouth"
                    , "category": "People"
                    , "aliases": [
                        "frowning"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.1"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😧"
                    , "description": "anguished face"
                    , "category": "People"
                    , "aliases": [
                        "anguished"
                    ]
                    , "tags": [
                        "stunned"
                    ]
                    , "unicode_version": "6.1"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😮"
                    , "description": "face with open mouth"
                    , "category": "People"
                    , "aliases": [
                        "open_mouth"
                    ]
                    , "tags": [
                        "surprise"
                        , "impressed"
                        , "wow"
                    ]
                    , "unicode_version": "6.1"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😲"
                    , "description": "astonished face"
                    , "category": "People"
                    , "aliases": [
                        "astonished"
                    ]
                    , "tags": [
                        "amazed"
                        , "gasp"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😵"
                    , "description": "dizzy face"
                    , "category": "People"
                    , "aliases": [
                        "dizzy_face"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😳"
                    , "description": "flushed face"
                    , "category": "People"
                    , "aliases": [
                        "flushed"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😱"
                    , "description": "face screaming in fear"
                    , "category": "People"
                    , "aliases": [
                        "scream"
                    ]
                    , "tags": [
                        "horror"
                        , "shocked"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😨"
                    , "description": "fearful face"
                    , "category": "People"
                    , "aliases": [
                        "fearful"
                    ]
                    , "tags": [
                        "scared"
                        , "shocked"
                        , "oops"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😰"
                    , "description": "face with open mouth & cold sweat"
                    , "category": "People"
                    , "aliases": [
                        "cold_sweat"
                    ]
                    , "tags": [
                        "nervous"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😢"
                    , "description": "crying face"
                    , "category": "People"
                    , "aliases": [
                        "cry"
                    ]
                    , "tags": [
                        "sad"
                        , "tear"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😥"
                    , "description": "disappointed but relieved face"
                    , "category": "People"
                    , "aliases": [
                        "disappointed_relieved"
                    ]
                    , "tags": [
                        "phew"
                        , "sweat"
                        , "nervous"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🤤"
                    , "description": "drooling face"
                    , "category": "People"
                    , "aliases": [
                        "drooling_face"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "😭"
                    , "description": "loudly crying face"
                    , "category": "People"
                    , "aliases": [
                        "sob"
                    ]
                    , "tags": [
                        "sad"
                        , "cry"
                        , "bawling"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😓"
                    , "description": "face with cold sweat"
                    , "category": "People"
                    , "aliases": [
                        "sweat"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😪"
                    , "description": "sleepy face"
                    , "category": "People"
                    , "aliases": [
                        "sleepy"
                    ]
                    , "tags": [
                        "tired"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😴"
                    , "description": "sleeping face"
                    , "category": "People"
                    , "aliases": [
                        "sleeping"
                    ]
                    , "tags": [
                        "zzz"
                    ]
                    , "unicode_version": "6.1"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🙄"
                    , "description": "face with rolling eyes"
                    , "category": "People"
                    , "aliases": [
                        "roll_eyes"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "8.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "🤔"
                    , "description": "thinking face"
                    , "category": "People"
                    , "aliases": [
                        "thinking"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "8.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "🤥"
                    , "description": "lying face"
                    , "category": "People"
                    , "aliases": [
                        "lying_face"
                    ]
                    , "tags": [
                        "liar"
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "😬"
                    , "description": "grimacing face"
                    , "category": "People"
                    , "aliases": [
                        "grimacing"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.1"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🤐"
                    , "description": "zipper-mouth face"
                    , "category": "People"
                    , "aliases": [
                        "zipper_mouth_face"
                    ]
                    , "tags": [
                        "silence"
                        , "hush"
                    ]
                    , "unicode_version": "8.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "🤢"
                    , "description": "nauseated face"
                    , "category": "People"
                    , "aliases": [
                        "nauseated_face"
                    ]
                    , "tags": [
                        "sick"
                        , "barf"
                        , "disgusted"
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "🤧"
                    , "description": "sneezing face"
                    , "category": "People"
                    , "aliases": [
                        "sneezing_face"
                    ]
                    , "tags": [
                        "achoo"
                        , "sick"
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "😷"
                    , "description": "face with medical mask"
                    , "category": "People"
                    , "aliases": [
                        "mask"
                    ]
                    , "tags": [
                        "sick"
                        , "ill"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🤒"
                    , "description": "face with thermometer"
                    , "category": "People"
                    , "aliases": [
                        "face_with_thermometer"
                    ]
                    , "tags": [
                        "sick"
                    ]
                    , "unicode_version": "8.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "🤕"
                    , "description": "face with head-bandage"
                    , "category": "People"
                    , "aliases": [
                        "face_with_head_bandage"
                    ]
                    , "tags": [
                        "hurt"
                    ]
                    , "unicode_version": "8.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "😈"
                    , "description": "smiling face with horns"
                    , "category": "People"
                    , "aliases": [
                        "smiling_imp"
                    ]
                    , "tags": [
                        "devil"
                        , "evil"
                        , "horns"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👿"
                    , "description": "angry face with horns"
                    , "category": "People"
                    , "aliases": [
                        "imp"
                    ]
                    , "tags": [
                        "angry"
                        , "devil"
                        , "evil"
                        , "horns"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👹"
                    , "description": "ogre"
                    , "category": "People"
                    , "aliases": [
                        "japanese_ogre"
                    ]
                    , "tags": [
                        "monster"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👺"
                    , "description": "goblin"
                    , "category": "People"
                    , "aliases": [
                        "japanese_goblin"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💩"
                    , "description": "pile of poo"
                    , "category": "People"
                    , "aliases": [
                        "hankey"
                        , "poop"
                        , "shit"
                    ]
                    , "tags": [
                        "crap"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👻"
                    , "description": "ghost"
                    , "category": "People"
                    , "aliases": [
                        "ghost"
                    ]
                    , "tags": [
                        "halloween"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💀"
                    , "description": "skull"
                    , "category": "People"
                    , "aliases": [
                        "skull"
                    ]
                    , "tags": [
                        "dead"
                        , "danger"
                        , "poison"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "☠️"
                    , "description": "skull and crossbones"
                    , "category": "People"
                    , "aliases": [
                        "skull_and_crossbones"
                    ]
                    , "tags": [
                        "danger"
                        , "pirate"
                    ]
                    , "unicode_version": ""
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "👽"
                    , "description": "alien"
                    , "category": "People"
                    , "aliases": [
                        "alien"
                    ]
                    , "tags": [
                        "ufo"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👾"
                    , "description": "alien monster"
                    , "category": "People"
                    , "aliases": [
                        "space_invader"
                    ]
                    , "tags": [
                        "game"
                        , "retro"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🤖"
                    , "description": "robot face"
                    , "category": "People"
                    , "aliases": [
                        "robot"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "8.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "🎃"
                    , "description": "jack-o-lantern"
                    , "category": "People"
                    , "aliases": [
                        "jack_o_lantern"
                    ]
                    , "tags": [
                        "halloween"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😺"
                    , "description": "smiling cat face with open mouth"
                    , "category": "People"
                    , "aliases": [
                        "smiley_cat"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😸"
                    , "description": "grinning cat face with smiling eyes"
                    , "category": "People"
                    , "aliases": [
                        "smile_cat"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😹"
                    , "description": "cat face with tears of joy"
                    , "category": "People"
                    , "aliases": [
                        "joy_cat"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😻"
                    , "description": "smiling cat face with heart-eyes"
                    , "category": "People"
                    , "aliases": [
                        "heart_eyes_cat"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😼"
                    , "description": "cat face with wry smile"
                    , "category": "People"
                    , "aliases": [
                        "smirk_cat"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😽"
                    , "description": "kissing cat face with closed eyes"
                    , "category": "People"
                    , "aliases": [
                        "kissing_cat"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🙀"
                    , "description": "weary cat face"
                    , "category": "People"
                    , "aliases": [
                        "scream_cat"
                    ]
                    , "tags": [
                        "horror"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😿"
                    , "description": "crying cat face"
                    , "category": "People"
                    , "aliases": [
                        "crying_cat_face"
                    ]
                    , "tags": [
                        "sad"
                        , "tear"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "😾"
                    , "description": "pouting cat face"
                    , "category": "People"
                    , "aliases": [
                        "pouting_cat"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👐"
                    , "description": "open hands"
                    , "category": "People"
                    , "aliases": [
                        "open_hands"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🙌"
                    , "description": "raising hands"
                    , "category": "People"
                    , "aliases": [
                        "raised_hands"
                    ]
                    , "tags": [
                        "hooray"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👏"
                    , "description": "clapping hands"
                    , "category": "People"
                    , "aliases": [
                        "clap"
                    ]
                    , "tags": [
                        "praise"
                        , "applause"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🙏"
                    , "description": "folded hands"
                    , "category": "People"
                    , "aliases": [
                        "pray"
                    ]
                    , "tags": [
                        "please"
                        , "hope"
                        , "wish"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🤝"
                    , "description": "handshake"
                    , "category": "People"
                    , "aliases": [
                        "handshake"
                    ]
                    , "tags": [
                        "deal"
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "👍"
                    , "description": "thumbs up"
                    , "category": "People"
                    , "aliases": [
                        "+1"
                        , "thumbsup"
                    ]
                    , "tags": [
                        "approve"
                        , "ok"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👎"
                    , "description": "thumbs down"
                    , "category": "People"
                    , "aliases": [
                        "-1"
                        , "thumbsdown"
                    ]
                    , "tags": [
                        "disapprove"
                        , "bury"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👊"
                    , "description": "oncoming fist"
                    , "category": "People"
                    , "aliases": [
                        "fist_oncoming"
                        , "facepunch"
                        , "punch"
                    ]
                    , "tags": [
                        "attack"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "✊"
                    , "description": "raised fist"
                    , "category": "People"
                    , "aliases": [
                        "fist_raised"
                        , "fist"
                    ]
                    , "tags": [
                        "power"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🤛"
                    , "description": "left-facing fist"
                    , "category": "People"
                    , "aliases": [
                        "fist_left"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "🤜"
                    , "description": "right-facing fist"
                    , "category": "People"
                    , "aliases": [
                        "fist_right"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "🤞"
                    , "description": "crossed fingers"
                    , "category": "People"
                    , "aliases": [
                        "crossed_fingers"
                    ]
                    , "tags": [
                        "luck"
                        , "hopeful"
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "✌️"
                    , "description": "victory hand"
                    , "category": "People"
                    , "aliases": [
                        "v"
                    ]
                    , "tags": [
                        "victory"
                        , "peace"
                    ]
                    , "unicode_version": ""
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🤘"
                    , "description": "sign of the horns"
                    , "category": "People"
                    , "aliases": [
                        "metal"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "8.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "👌"
                    , "description": "OK hand"
                    , "category": "People"
                    , "aliases": [
                        "ok_hand"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👈"
                    , "description": "backhand index pointing left"
                    , "category": "People"
                    , "aliases": [
                        "point_left"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👉"
                    , "description": "backhand index pointing right"
                    , "category": "People"
                    , "aliases": [
                        "point_right"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👆"
                    , "description": "backhand index pointing up"
                    , "category": "People"
                    , "aliases": [
                        "point_up_2"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👇"
                    , "description": "backhand index pointing down"
                    , "category": "People"
                    , "aliases": [
                        "point_down"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "☝️"
                    , "description": "index pointing up"
                    , "category": "People"
                    , "aliases": [
                        "point_up"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": ""
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "✋"
                    , "description": "raised hand"
                    , "category": "People"
                    , "aliases": [
                        "hand"
                        , "raised_hand"
                    ]
                    , "tags": [
                        "highfive"
                        , "stop"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🤚"
                    , "description": "raised back of hand"
                    , "category": "People"
                    , "aliases": [
                        "raised_back_of_hand"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "🖐"
                    , "description": "raised hand with fingers splayed"
                    , "category": "People"
                    , "aliases": [
                        "raised_hand_with_fingers_splayed"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "7.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "🖖"
                    , "description": "vulcan salute"
                    , "category": "People"
                    , "aliases": [
                        "vulcan_salute"
                    ]
                    , "tags": [
                        "prosper"
                        , "spock"
                    ]
                    , "unicode_version": "7.0"
                    , "ios_version": "8.3"
                }
                , {
                    "emoji": "👋"
                    , "description": "waving hand"
                    , "category": "People"
                    , "aliases": [
                        "wave"
                    ]
                    , "tags": [
                        "goodbye"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🤙"
                    , "description": "call me hand"
                    , "category": "People"
                    , "aliases": [
                        "call_me_hand"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "💪"
                    , "description": "flexed biceps"
                    , "category": "People"
                    , "aliases": [
                        "muscle"
                    ]
                    , "tags": [
                        "flex"
                        , "bicep"
                        , "strong"
                        , "workout"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🖕"
                    , "description": "middle finger"
                    , "category": "People"
                    , "aliases": [
                        "middle_finger"
                        , "fu"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "7.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "✍️"
                    , "description": "writing hand"
                    , "category": "People"
                    , "aliases": [
                        "writing_hand"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": ""
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "🤳"
                    , "description": "selfie"
                    , "category": "People"
                    , "aliases": [
                        "selfie"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "💅"
                    , "description": "nail polish"
                    , "category": "People"
                    , "aliases": [
                        "nail_care"
                    ]
                    , "tags": [
                        "beauty"
                        , "manicure"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💍"
                    , "description": "ring"
                    , "category": "People"
                    , "aliases": [
                        "ring"
                    ]
                    , "tags": [
                        "wedding"
                        , "marriage"
                        , "engaged"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💄"
                    , "description": "lipstick"
                    , "category": "People"
                    , "aliases": [
                        "lipstick"
                    ]
                    , "tags": [
                        "makeup"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💋"
                    , "description": "kiss mark"
                    , "category": "People"
                    , "aliases": [
                        "kiss"
                    ]
                    , "tags": [
                        "lipstick"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👄"
                    , "description": "mouth"
                    , "category": "People"
                    , "aliases": [
                        "lips"
                    ]
                    , "tags": [
                        "kiss"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👅"
                    , "description": "tongue"
                    , "category": "People"
                    , "aliases": [
                        "tongue"
                    ]
                    , "tags": [
                        "taste"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👂"
                    , "description": "ear"
                    , "category": "People"
                    , "aliases": [
                        "ear"
                    ]
                    , "tags": [
                        "hear"
                        , "sound"
                        , "listen"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👃"
                    , "description": "nose"
                    , "category": "People"
                    , "aliases": [
                        "nose"
                    ]
                    , "tags": [
                        "smell"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👣"
                    , "description": "footprints"
                    , "category": "People"
                    , "aliases": [
                        "footprints"
                    ]
                    , "tags": [
                        "feet"
                        , "tracks"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👁"
                    , "description": "eye"
                    , "category": "People"
                    , "aliases": [
                        "eye"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "7.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "👀"
                    , "description": "eyes"
                    , "category": "People"
                    , "aliases": [
                        "eyes"
                    ]
                    , "tags": [
                        "look"
                        , "see"
                        , "watch"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🗣"
                    , "description": "speaking head"
                    , "category": "People"
                    , "aliases": [
                        "speaking_head"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "7.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "👤"
                    , "description": "bust in silhouette"
                    , "category": "People"
                    , "aliases": [
                        "bust_in_silhouette"
                    ]
                    , "tags": [
                        "user"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👥"
                    , "description": "busts in silhouette"
                    , "category": "People"
                    , "aliases": [
                        "busts_in_silhouette"
                    ]
                    , "tags": [
                        "users"
                        , "group"
                        , "team"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👶"
                    , "description": "baby"
                    , "category": "People"
                    , "aliases": [
                        "baby"
                    ]
                    , "tags": [
                        "child"
                        , "newborn"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👦"
                    , "description": "boy"
                    , "category": "People"
                    , "aliases": [
                        "boy"
                    ]
                    , "tags": [
                        "child"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👧"
                    , "description": "girl"
                    , "category": "People"
                    , "aliases": [
                        "girl"
                    ]
                    , "tags": [
                        "child"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👨"
                    , "description": "man"
                    , "category": "People"
                    , "aliases": [
                        "man"
                    ]
                    , "tags": [
                        "mustache"
                        , "father"
                        , "dad"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👩"
                    , "description": "woman"
                    , "category": "People"
                    , "aliases": [
                        "woman"
                    ]
                    , "tags": [
                        "girls"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👱‍♀"
                    , "description": "blond-haired woman"
                    , "category": "People"
                    , "aliases": [
                        "blonde_woman"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "10.0"
                }
                , {
                    "emoji": "👱"
                    , "description": "blond-haired person"
                    , "category": "People"
                    , "aliases": [
                        "blonde_man"
                        , "person_with_blond_hair"
                    ]
                    , "tags": [
                        "boy"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👴"
                    , "description": "old man"
                    , "category": "People"
                    , "aliases": [
                        "older_man"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👵"
                    , "description": "old woman"
                    , "category": "People"
                    , "aliases": [
                        "older_woman"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👲"
                    , "description": "man with Chinese cap"
                    , "category": "People"
                    , "aliases": [
                        "man_with_gua_pi_mao"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👳‍♀"
                    , "description": "woman wearing turban"
                    , "category": "People"
                    , "aliases": [
                        "woman_with_turban"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "10.0"
                }
                , {
                    "emoji": "👳"
                    , "description": "person wearing turban"
                    , "category": "People"
                    , "aliases": [
                        "man_with_turban"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👮‍♀"
                    , "description": "woman police officer"
                    , "category": "People"
                    , "aliases": [
                        "policewoman"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "10.0"
                }
                , {
                    "emoji": "👮"
                    , "description": "police officer"
                    , "category": "People"
                    , "aliases": [
                        "policeman"
                        , "cop"
                    ]
                    , "tags": [
                        "police"
                        , "law"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👷‍♀"
                    , "description": "woman construction worker"
                    , "category": "People"
                    , "aliases": [
                        "construction_worker_woman"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "10.0"
                }
                , {
                    "emoji": "👷"
                    , "description": "construction worker"
                    , "category": "People"
                    , "aliases": [
                        "construction_worker_man"
                        , "construction_worker"
                    ]
                    , "tags": [
                        "helmet"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💂‍♀"
                    , "description": "woman guard"
                    , "category": "People"
                    , "aliases": [
                        "guardswoman"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "10.0"
                }
                , {
                    "emoji": "💂"
                    , "description": "guard"
                    , "category": "People"
                    , "aliases": [
                        "guardsman"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🕵️‍♀️"
                    , "description": "woman detective"
                    , "category": "People"
                    , "aliases": [
                        "female_detective"
                    ]
                    , "tags": [
                        "sleuth"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "10.0"
                }
                , {
                    "emoji": "🕵"
                    , "description": "detective"
                    , "category": "People"
                    , "aliases": [
                        "male_detective"
                        , "detective"
                    ]
                    , "tags": [
                        "sleuth"
                    ]
                    , "unicode_version": "7.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "👩‍❤️‍👩"
                    , "description": "couple with heart: woman, woman"
                    , "category": "People"
                    , "aliases": [
                        "couple_with_heart_woman_woman"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "8.3"
                }
                , {
                    "emoji": "👨‍❤️‍👨"
                    , "description": "couple with heart: man, man"
                    , "category": "People"
                    , "aliases": [
                        "couple_with_heart_man_man"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "8.3"
                }
                , {
                    "emoji": "💏"
                    , "description": "kiss"
                    , "category": "People"
                    , "aliases": [
                        "couplekiss_man_woman"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "👩‍❤️‍💋‍👩"
                    , "description": "kiss: woman, woman"
                    , "category": "People"
                    , "aliases": [
                        "couplekiss_woman_woman"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "8.3"
                }
                , {
                    "emoji": "👨‍❤️‍💋‍👨"
                    , "description": "kiss: man, man"
                    , "category": "People"
                    , "aliases": [
                        "couplekiss_man_man"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "8.3"
                }
                , {
                    "emoji": "👪"
                    , "description": "family"
                    , "category": "People"
                    , "aliases": [
                        "family_man_woman_boy"
                        , "family"
                    ]
                    , "tags": [
                        "home"
                        , "parents"
                        , "child"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🌻"
                    , "description": "sunflower"
                    , "category": "Nature"
                    , "aliases": [
                        "sunflower"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🌼"
                    , "description": "blossom"
                    , "category": "Nature"
                    , "aliases": [
                        "blossom"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🌸"
                    , "description": "cherry blossom"
                    , "category": "Nature"
                    , "aliases": [
                        "cherry_blossom"
                    ]
                    , "tags": [
                        "flower"
                        , "spring"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🌺"
                    , "description": "hibiscus"
                    , "category": "Nature"
                    , "aliases": [
                        "hibiscus"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }

                , {
                    "emoji": "🍏"
                    , "description": "green apple"
                    , "category": "Foods"
                    , "aliases": [
                        "green_apple"
                    ]
                    , "tags": [
                        "fruit"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🍎"
                    , "description": "red apple"
                    , "category": "Foods"
                    , "aliases": [
                        "apple"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🍐"
                    , "description": "pear"
                    , "category": "Foods"
                    , "aliases": [
                        "pear"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🍊"
                    , "description": "tangerine"
                    , "category": "Foods"
                    , "aliases": [
                        "tangerine"
                        , "orange"
                        , "mandarin"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🍋"
                    , "description": "lemon"
                    , "category": "Foods"
                    , "aliases": [
                        "lemon"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🍌"
                    , "description": "banana"
                    , "category": "Foods"
                    , "aliases": [
                        "banana"
                    ]
                    , "tags": [
                        "fruit"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🍉"
                    , "description": "watermelon"
                    , "category": "Foods"
                    , "aliases": [
                        "watermelon"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🍇"
                    , "description": "grapes"
                    , "category": "Foods"
                    , "aliases": [
                        "grapes"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🍓"
                    , "description": "strawberry"
                    , "category": "Foods"
                    , "aliases": [
                        "strawberry"
                    ]
                    , "tags": [
                        "fruit"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🍈"
                    , "description": "melon"
                    , "category": "Foods"
                    , "aliases": [
                        "melon"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🍒"
                    , "description": "cherries"
                    , "category": "Foods"
                    , "aliases": [
                        "cherries"
                    ]
                    , "tags": [
                        "fruit"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🍑"
                    , "description": "peach"
                    , "category": "Foods"
                    , "aliases": [
                        "peach"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🍍"
                    , "description": "pineapple"
                    , "category": "Foods"
                    , "aliases": [
                        "pineapple"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🥝"
                    , "description": "kiwi fruit"
                    , "category": "Foods"
                    , "aliases": [
                        "kiwi_fruit"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "🥑"
                    , "description": "avocado"
                    , "category": "Foods"
                    , "aliases": [
                        "avocado"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "🍅"
                    , "description": "tomato"
                    , "category": "Foods"
                    , "aliases": [
                        "tomato"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🍆"
                    , "description": "eggplant"
                    , "category": "Foods"
                    , "aliases": [
                        "eggplant"
                    ]
                    , "tags": [
                        "aubergine"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🥒"
                    , "description": "cucumber"
                    , "category": "Foods"
                    , "aliases": [
                        "cucumber"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "🥕"
                    , "description": "carrot"
                    , "category": "Foods"
                    , "aliases": [
                        "carrot"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "🌽"
                    , "description": "ear of corn"
                    , "category": "Foods"
                    , "aliases": [
                        "corn"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🌶"
                    , "description": "hot pepper"
                    , "category": "Foods"
                    , "aliases": [
                        "hot_pepper"
                    ]
                    , "tags": [
                        "spicy"
                    ]
                    , "unicode_version": "7.0"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "🥔"
                    , "description": "potato"
                    , "category": "Foods"
                    , "aliases": [
                        "potato"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "🍠"
                    , "description": "roasted sweet potato"
                    , "category": "Foods"
                    , "aliases": [
                        "sweet_potato"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🌰"
                    , "description": "chestnut"
                    , "category": "Foods"
                    , "aliases": [
                        "chestnut"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🥜"
                    , "description": "peanuts"
                    , "category": "Foods"
                    , "aliases": [
                        "peanuts"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "🍯"
                    , "description": "honey pot"
                    , "category": "Foods"
                    , "aliases": [
                        "honey_pot"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🥐"
                    , "description": "croissant"
                    , "category": "Foods"
                    , "aliases": [
                        "croissant"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "🥁"
                    , "description": "drum"
                    , "category": "Activity"
                    , "aliases": [
                        "drum"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": ""
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "🎷"
                    , "description": "saxophone"
                    , "category": "Activity"
                    , "aliases": [
                        "saxophone"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🎺"
                    , "description": "trumpet"
                    , "category": "Activity"
                    , "aliases": [
                        "trumpet"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🎸"
                    , "description": "guitar"
                    , "category": "Activity"
                    , "aliases": [
                        "guitar"
                    ]
                    , "tags": [
                        "rock"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🎻"
                    , "description": "violin"
                    , "category": "Activity"
                    , "aliases": [
                        "violin"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🎲"
                    , "description": "game die"
                    , "category": "Activity"
                    , "aliases": [
                        "game_die"
                    ]
                    , "tags": [
                        "dice"
                        , "gambling"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🎯"
                    , "description": "direct hit"
                    , "category": "Activity"
                    , "aliases": [
                        "dart"
                    ]
                    , "tags": [
                        "target"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🎳"
                    , "description": "bowling"
                    , "category": "Activity"
                    , "aliases": [
                        "bowling"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🎮"
                    , "description": "video game"
                    , "category": "Activity"
                    , "aliases": [
                        "video_game"
                    ]
                    , "tags": [
                        "play"
                        , "controller"
                        , "console"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💵"
                    , "description": "dollar banknote"
                    , "category": "Objects"
                    , "aliases": [
                        "dollar"
                    ]
                    , "tags": [
                        "money"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💴"
                    , "description": "yen banknote"
                    , "category": "Objects"
                    , "aliases": [
                        "yen"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💶"
                    , "description": "euro banknote"
                    , "category": "Objects"
                    , "aliases": [
                        "euro"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💷"
                    , "description": "pound banknote"
                    , "category": "Objects"
                    , "aliases": [
                        "pound"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💰"
                    , "description": "money bag"
                    , "category": "Objects"
                    , "aliases": [
                        "moneybag"
                    ]
                    , "tags": [
                        "dollar"
                        , "cream"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💳"
                    , "description": "credit card"
                    , "category": "Objects"
                    , "aliases": [
                        "credit_card"
                    ]
                    , "tags": [
                        "subscription"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💎"
                    , "description": "gem stone"
                    , "category": "Objects"
                    , "aliases": [
                        "gem"
                    ]
                    , "tags": [
                        "diamond"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "⚖️"
                    , "description": "balance scale"
                    , "category": "Objects"
                    , "aliases": [
                        "balance_scale"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "4.1"
                    , "ios_version": "9.1"
                }
                , {
                    "emoji": "🛒"
                    , "description": "shopping cart"
                    , "category": "Objects"
                    , "aliases": [
                        "shopping_cart"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "❤️"
                    , "description": "red heart"
                    , "category": "Symbols"
                    , "aliases": [
                        "heart"
                    ]
                    , "tags": [
                        "love"
                    ]
                    , "unicode_version": ""
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💛"
                    , "description": "yellow heart"
                    , "category": "Symbols"
                    , "aliases": [
                        "yellow_heart"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💚"
                    , "description": "green heart"
                    , "category": "Symbols"
                    , "aliases": [
                        "green_heart"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💙"
                    , "description": "blue heart"
                    , "category": "Symbols"
                    , "aliases": [
                        "blue_heart"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "💜"
                    , "description": "purple heart"
                    , "category": "Symbols"
                    , "aliases": [
                        "purple_heart"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🖤"
                    , "description": "black heart"
                    , "category": "Symbols"
                    , "aliases": [
                        "black_heart"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "9.0"
                    , "ios_version": "10.2"
                }
                , {
                    "emoji": "💔"
                    , "description": "broken heart"
                    , "category": "Symbols"
                    , "aliases": [
                        "broken_heart"
                    ]
                    , "tags": [
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "6.0"
                }
                , {
                    "emoji": "🏳️‍🌈"
                    , "description": "rainbow flag"
                    , "category": "Flags"
                    , "aliases": [
                        "rainbow_flag"
                    ]
                    , "tags": [
                        "pride"
                    ]
                    , "unicode_version": "6.0"
                    , "ios_version": "10.0"
                }
            ];


            var menuItems = {
                'fonteffects': true,
                'texteffects': true,
                'aligneffects': true,
                // 'textformats': true,
                'actions': true,
                'insertoptions': true,
                'extraeffects': true,
                'advancedoptions': true,
                'screeneffects': true,

                'fonts': {
                    "select": true,
                    "default": "Font",
                    "tooltip": "Fonts",
                    "commandname": "fontName",
                    "custom": null
                },

                // 'styles': {
                //     "select": true,
                //     "default": "Formatting",
                //     "tooltip": "Paragraph Format",
                //     "commandname": "formatBlock",
                //     "custom": null
                // },

                'font_size': {
                    "select": true,
                    "default": "Font size",
                    "tooltip": "Font Size",
                    "commandname": "fontSize",
                    "custom": null
                },

                'color': {
                    "text": "A",
                    "icon": "fa fa-eyedropper",
                    "tooltip": "Text/Background Color",
                    "commandname": null,
                    "custom": function (button) {
                        var editor = $(this);
                        var flag = 0;
                        var paletteCntr = $('<div/>', {
                            id: "paletteCntr",
                            class: "activeColour",
                            css: {"display": "none", "width": "335px"}
                        }).click(function (event) {
                            event.stopPropagation();
                        });
                        var paletteDiv = $('<div/>', {id: "colorpellete"});
                        var palette = $('<ul />', {id: "color_ui"}).append($('<li />').css({
                            "width": "145px",
                            "display": "Block",
                            "height": "25px"
                        }).html('<div>Text Color</div>'));
                        var bgPalletteDiv = $('<div/>', {id: "bg_colorpellete"});
                        var bgPallette = $('<ul />', {id: "bgcolor_ui"}).append($('<li />').css({
                            "width": "145px",
                            "display": "Block",
                            "height": "25px"
                        }).html('<div>Background Color</div>'));
                        if (editor.data("colorBtn")) {
                            flag = 1;
                            editor.data("colorBtn", null);
                        }
                        else
                            editor.data("colorBtn", 1);
                        if (flag == 0) {
                            for (var i = 0; i < colors.length; i++) {
                                if (colors[i].hex != null) {
                                    palette.append($('<li />').css('background-color', colors[i].hex).mousedown(function (event) {
                                        event.preventDefault();
                                    }).click(function () {
                                        var hexcolor = methods.rgbToHex.apply(this, [$(this).css('background-color')]);
                                        methods.restoreSelection.apply(this);
                                        methods.setStyleWithCSS.apply(this);
                                        document.execCommand('forecolor', false, hexcolor);
                                        $('#paletteCntr').remove();

                                        editor.data("colorBtn", null);
                                    }));

                                    bgPallette.append($('<li />').css('background-color', colors[i].hex).mousedown(function (event) {
                                        event.preventDefault();
                                    }).click(function () {
                                        var hexcolor = methods.rgbToHex.apply(this, [$(this).css('background-color')]);
                                        methods.restoreSelection.apply(this);
                                        methods.setStyleWithCSS.apply(this);
                                        document.execCommand('backColor', false, hexcolor);
                                        $('#paletteCntr').remove();
                                        editor.data("colorBtn", null);
                                    }));
                                }
                                else {
                                    palette.append($('<li />').css({
                                        "width": "145px",
                                        "display": "Block",
                                        "height": "5px"
                                    }));
                                    bgPallette.append($('<li />').css({
                                        "width": "145px",
                                        "display": "Block",
                                        "height": "5px"
                                    }));
                                }
                            }
                            palette.appendTo(paletteDiv);
                            bgPallette.appendTo(bgPalletteDiv);
                            paletteDiv.appendTo(paletteCntr);
                            bgPalletteDiv.appendTo(paletteCntr)
                            paletteCntr.insertAfter(button);
                            $('#paletteCntr').slideDown('slow');
                        }
                        else
                            $('#paletteCntr').remove();
                    }
                },

                'bold': {
                    "text": "B",
                    "icon": "fa fa-bold",
                    "tooltip": "Bold",
                    "commandname": "bold",
                    "custom": null
                },

                'italics': {
                    "text": "I",
                    "icon": "fa fa-italic",
                    "tooltip": "Italics",
                    "commandname": "italic",
                    "custom": null
                },

                'underline': {
                    "text": "U",
                    "icon": "fa fa-underline",
                    "tooltip": "Underline",
                    "commandname": "underline",
                    "custom": null
                },

                'strikeout': {
                    "text": "Strikeout",
                    "icon": "fa fa-strikethrough",
                    "tooltip": "Strike Through",
                    "commandname": "strikeThrough",
                    "custom": null
                },

                // 'ol': {
                //     "text": "N",
                //     "icon": "fa fa-list-ol",
                //     "tooltip": "Insert/Remove Numbered List",
                //     "commandname": "insertorderedlist",
                //     "custom": null
                // },

                // 'ul': {
                //     "text": "Bullet",
                //     "icon": "fa fa-list-ul",
                //     "tooltip": "Insert/Remove Bulleted List",
                //     "commandname": "insertunorderedlist",
                //     "custom": null
                // },

                'undo': {
                    "text": "undo",
                    "icon": "fa fa-undo",
                    "tooltip": "Undo",
                    "commandname": "undo",
                    "custom": null
                },

                'redo': {
                    "text": "redo",
                    "icon": "fa fa-repeat",
                    "tooltip": "Redo",
                    "commandname": "redo",
                    "custom": null
                },

                'l_align': {
                    "text": "leftalign",
                    "icon": "fa fa-align-left",
                    "tooltip": "Align Left",
                    "commandname": "justifyleft",
                    "custom": null
                },

                'r_align': {
                    "text": "rightalign",
                    "icon": "fa fa-align-right",
                    "tooltip": "Align Right",
                    "commandname": "justifyright",
                    "custom": null
                },

                'c_align': {
                    "text": "centeralign",
                    "icon": "fa fa-align-center",
                    "tooltip": "Align Center",
                    "commandname": "justifycenter",
                    "custom": null
                },

                'justify': {
                    "text": "justify",
                    "icon": "fa fa-align-justify",
                    "tooltip": "Justify",
                    "commandname": "justifyfull",
                    "custom": null
                },

                'unlink': {
                    "text": "Unlink",
                    "icon": "fa fa-unlink",
                    "tooltip": "Unlink",
                    "commandname": "unlink",
                    "custom": null
                },

                'insert_link': {
                    "modal": true,
                    "modalId": "InsertLink",
                    "icon": "fa fa-link",
                    "tooltip": "Insert Link",
                    "modalHeader": "Insert Hyperlink",
                    "modalBody": $('<div/>', {
                        class: "form-group"
                    }).append($('<div/>', {
                        id: "errMsg"
                    })).append($('<input/>', {
                        type: "text",
                        id: "inputText",
                        class: "form-control form-control-link ",
                        placeholder: "Text to Display",
                    })).append($('<input/>', {
                        type: "text",
                        id: "inputUrl",
                        required: true,
                        class: "form-control form-control-link",
                        placeholder: "Enter URL"
                    })),
                    "beforeLoad": function () {
                        editorObj = this;
                        $('#inputText').val("");
                        $('#inputUrl').val("");
                        $(".alert").alert("close");
                        if ($(editorObj).data('currentRange') != '') {
                            $('#inputText').val($(editorObj).data('currentRange'));
                        }
                    },
                    "onSave": function () {
                        var urlPattern = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
                        var targetText = $('#inputText').val();
                        var targetURL = $('#inputUrl').val();
                        var range = $(editorObj).data('currentRange');
                        if (targetURL == '') {
                            methods.showMessage.apply(editorObj, ["errMsg", "Please enter url"]);
                            return false;
                        }
                        if (!targetURL.match(urlPattern)) {
                            methods.showMessage.apply(editorObj, ["errMsg", "Enter valid url"]);
                            return false;
                        }
                        if (range == '' && targetText == '') {
                            targetText = targetURL;
                        }
                        if (navigator.userAgent.match(/MSIE/i)) {
                            var targetLink = '<a href="' + targetURL + '" target="_blank">' + targetText + '</a>';
                            methods.restoreSelection.apply(editorObj, [targetLink, 'html']);
                        }
                        else {
                            methods.restoreSelection.apply(editorObj, [targetText]);
                            document.execCommand('createLink', false, targetURL);
                        }
                        $(editorObj).data("editor").find('a[href="' + targetURL + '"]').each(function () {
                            $(this).attr("target", "_blank");
                        });
                        $(".alert").alert("close");
                        $("#InsertLink").modal("hide");
                        $(editorObj).data("editor").focus();
                        return false;
                    }
                },

                'insert_img': {
                    "modal": true,
                    "modalId": "InsertImage",
                    "icon": "fa fa-picture-o",
                    "tooltip": "Insert Image",
                    "modalHeader": "Insert Image",
                    "modalBody": methods.imageWidget.apply(this),
                    "beforeLoad": function () {
                        $('#imageURL').val("");
                        $("#uploadImageBar :input").val("");
                        $('#imageList').data('current', "");
                    },
                    "onSave": function () {
                        methods.restoreSelection.apply(this);
                        if ($('#imageList').data('current')) {
                            if (navigator.userAgent.match(/MSIE/i)) {
                                var imageStr = '<img src="' + $('#imageList').data('current') + '"/>'
                                methods.restoreSelection.apply(this, [imageStr, 'html'])
                            }
                            else {
                                document.execCommand('insertimage', false, $('#imageList').data('current'));
                            }
                        }
                        else {
                            methods.showMessage.apply(this, ["imgErrMsg", "Please select an image"]);
                            return false;
                        }
                        $("#InsertImage").modal("hide");
                        $(this).data("editor").focus();
                    }
                },

                // 'insert_table': {
                //     "modal": true,
                //     "modalId": "InsertTable",
                //     "icon": "fa fa-table",
                //     "tooltip": "Insert Table",
                //     "modalHeader": "Insert Table",
                //     "modalBody": methods.tableWidget.apply(this),
                //     "beforeLoad": function () {
                //         $('#tblForm').each(function () {
                //             this.reset();
                //         });
                //     },
                //     "onSave": function () {
                //         methods.restoreSelection.apply(this);
                //         var tblRows = $('#tblRows').val();
                //         var tblColumns = $('#tblColumns').val();
                //         var tblWidth = $('#tblWidth').val();
                //         var tblHeight = $('#tblHeight').val();
                //         var tblAlign = $('#tblAlign').val();
                //         var tblBorder = $('#tblBorder').val();
                //         var tblCellspacing = $('#tblCellspacing').val();
                //         var tblCellpadding = $('#tblCellpadding').val();
                //         var intReg = /^[0-9]+$/;
                //         var cssReg = /^auto$|^[+-]?[0-9]+\.?([0-9]+)?(px|em|ex|%|in|cm|mm|pt|pc)?$/ig;
                //         var numReg = /^[0-9]+\.?([0-9])?$/;
                //
                //         if (!tblRows.match(intReg)) {
                //             methods.showMessage.apply(this, ["tblErrMsg", "Rows must be a positive number"]);
                //             return false;
                //         }
                //         if (!tblColumns.match(intReg)) {
                //             methods.showMessage.apply(this, ["tblErrMsg", "Columns must be a positive number"]);
                //             return false;
                //         }
                //         if (tblWidth != "" && !tblWidth.match(cssReg)) {
                //             methods.showMessage.apply(this, ["tblErrMsg", "Please enter positive number with or without a valid CSS measurement unit (px,em,ex,%,in,cm,mm,pt,pc)"]);
                //             return false;
                //         }
                //         if (tblHeight != "" && !tblHeight.match(cssReg)) {
                //             methods.showMessage.apply(this, ["tblErrMsg", "Please enter positive number with or without a valid CSS measurement unit (px,em,ex,%,in,cm,mm,pt,pc)"]);
                //             return false;
                //         }
                //         if (tblBorder != "" && !tblBorder.match(numReg)) {
                //             methods.showMessage.apply(this, ["tblErrMsg", "Border size must be a positive number"]);
                //             return false;
                //         }
                //         if (tblCellspacing != "" && !tblCellspacing.match(numReg)) {
                //             methods.showMessage.apply(this, ["tblErrMsg", "Cell spacing must be a positive number"]);
                //             return false;
                //         }
                //         if (tblCellpadding != "" && !tblCellpadding.match(numReg)) {
                //             methods.showMessage.apply(this, ["tblErrMsg", "Cell padding must be a positive number"]);
                //             return false;
                //         }
                //
                //         var htmlTableCntr = $('<div/>');
                //         var tblAttributes = [
                //             {attribute: "align", value: tblAlign},
                //             {attribute: "border", value: tblBorder},
                //             {attribute: "cellspacing", value: tblCellspacing},
                //             {attribute: "cellpadding", value: tblCellpadding},
                //             {attribute: "width", value: tblWidth},
                //             {attribute: "height", value: tblHeight},
                //         ];
                //         var htmlTable = methods.getHTMLTable.apply(this, [tblRows, tblColumns, tblAttributes]);
                //         htmlTable.appendTo(htmlTableCntr);
                //         if (navigator.userAgent.match(/MSIE/i))
                //             methods.restoreSelection.apply(this, [htmlTableCntr.html(), 'html']);
                //         else
                //             document.execCommand('insertHTML', false, htmlTableCntr.html());
                //         $("#InsertTable").modal("hide");
                //         $(this).data("editor").focus();
                //     }
                // },

                // 'hr_line': {
                //     "text": "HR",
                //     "icon": "fa fa-minus",
                //     "tooltip": "Horizontal Rule",
                //     "commandname": "insertHorizontalRule",
                //     "custom": null
                // },

                // 'block_quote': {
                //     "text": "Block Quote",
                //     "icon": "fa fa-quote-right",
                //     "tooltip": "Block Quote",
                //     "commandname": null,
                //     "custom": function () {
                //         methods.setStyleWithCSS.apply(this);
                //         if (navigator.userAgent.match(/MSIE/i)) {
                //             document.execCommand('indent', false, null);
                //         }
                //         else {
                //             document.execCommand('formatBlock', false, '<blockquote>');
                //         }
                //     }
                // },

                'indent': {
                    "text": "Indent",
                    "icon": "fa fa-indent",
                    "tooltip": "Increase Indent",
                    "commandname": "indent",
                    "custom": null
                },

                'outdent': {
                    "text": "Outdent",
                    "icon": "fa fa-outdent",
                    "tooltip": "Decrease Indent",
                    "commandname": "outdent",
                    "custom": null
                },

                // 'print': {
                //     "text": "Print",
                //     "icon": "fa fa-print",
                //     "tooltip": "Print",
                //     "commandname": null,
                //     "custom": function () {
                //         oDoc = $(this).data("editor");
                //         console.log(oDoc.html());
                //         console.log(templateId);
                //
                //         $.ajax({
                //             type: "get",
                //             url: "/shop/email_detail/savedata",
                //             data: oDoc.html(),
                //             cache: false,
                //             contentType: false,
                //             processData: false,
                //             success: function (data) {
                //                 //alert("---"+data);
                //                 // alert("Settings has been updated successfully.");
                //                 // window.location('shop/email/detail');
                //             }
                //         });
                //
                //         var oPrntWin = window.open("", "_blank", "width=450,height=470,left=400,top=100,menubar=yes,toolbar=no,location=no,scrollbars=yes");
                //         oPrntWin.document.open();
                //         oPrntWin.document.write("<!doctype html><html><head><title>Print</title></head><body onload=\"print();\">" + oDoc.html() + "</body></html>");
                //         oPrntWin.document.close();
                //     }
                // },

                // 'rm_format': {
                //     "text": "Remove format",
                //     "icon": "fa fa-eraser",
                //     "tooltip": "Remove Formatting",
                //     "commandname": "removeformat",
                //     "custom": null
                // },

                // 'select_all': {
                //     "text": "Select all",
                //     "icon": "fa fa-file-text",
                //     "tooltip": "Select All",
                //     "commandname": null,
                //     "custom": function () {
                //         document.execCommand("selectall", null, null);
                //     }
                // },

                // 'togglescreen': {
                //     "text": "Toggle Screen",
                //     "icon": "fa fa-arrows-alt",
                //     "tooltip": "Toggle Screen",
                //     "commandname": null,
                //     "custom": function (button, parameters) {
                //         $(this).data("editor").parent().toggleClass('fullscreen');
                //         var statusdBarHeight = 0;
                //         if ($(this).data("statusBar").length) {
                //             statusdBarHeight = $(this).data("statusBar").height();
                //         }
                //         if ($(this).data("editor").parent().hasClass('fullscreen'))
                //             $(this).data("editor").css({"height": $(this).data("editor").parent().height() - ($(this).data("menuBar").height() + statusdBarHeight) - 13});
                //         else
                //             $(this).data("editor").css({"height": ""});
                //     }
                // },

                'splchars': {
                    "text": "😊",
                    "icon": "fa fa-smile-o",
                    "tooltip": "Insert Special Character",
                    "commandname": null,
                    "custom": function (button) {
                        methods.restoreIESelection.apply(this);
                        var flag = 0;
                        var splCharDiv = $('<div/>', {
                            id: "specialchar",
                            class: "specialCntr",
                            css: {"display": "none"}
                        }).click(function (event) {
                            event.stopPropagation();
                        });
                        var splCharUi = $('<ul />', {id: "special_ui"});
                        var editor_Content = this;
                        if ($(this).data("editor").data("splcharsBtn")) {
                            flag = 1;
                            $(this).data("editor").data("splcharsBtn", null);
                        }
                        else
                            $(this).data("editor").data("splcharsBtn", 1);

                        if (flag == 0) {
                            for (var i = 0; i < specialchars.length; i++) {
                                splCharUi.append($('<li />').html(specialchars[i].emoji).attr('title', specialchars[i].description).mousedown(function (event) {
                                    event.preventDefault();
                                }).click(function (event) {
                                    if (navigator.userAgent.match(/MSIE/i)) {
                                        var specCharHtml = $(this).html();
                                        methods.insertTextAtSelection.apply(this, [specCharHtml, 'html']);
                                    }
                                    else {
                                        document.execCommand('insertHTML', false, $(this).html());
                                    }
                                    $('#specialchar').remove();
                                    $(editor_Content).data("editor").data("splcharsBtn", null);
                                }));
                            }
                            splCharUi.prependTo(splCharDiv);
                            splCharDiv.insertAfter(button)
                            $('#specialchar').slideDown('slow');
                        }
                        else
                            $('#specialchar').remove();
                    }
                },

                // 'source': {
                //     "text": "Source",
                //     "icon": "fa fa-code",
                //     "tooltip": "Source",
                //     "commandname": null,
                //     "custom": function (button, params) {
                //         methods.getSource.apply(this, [button, params])
                //     }
                // },
                "params": {"obj": null},
            };

            var menuGroups = {
                'texteffects': ['bold', 'italics', 'underline', 'color'],
                'aligneffects': ['l_align', 'c_align', 'r_align', 'justify'],
                // 'textformats': ['indent', 'outdent', 'block_quote', 'ol', 'ul'],
                'fonteffects': ['fonts', 'font_size'],
                'actions': ['undo', 'redo'],
                'insertoptions': [ 'insert_img'],
                'extraeffects': ['splchars'],
                'advancedoptions': [],
                'screeneffects': []
            };


            var settings = $.extend({
                'texteffects': true,
                'textformats': true,
                'aligneffects': true,
                'fonteffects': true,
                'actions': true,
                'insertoptions': true,
                'extraeffects': true,
                'advancedoptions': true,
                'screeneffects': true,
                'bold': true,
                'italics': true,
                'underline': true,
                'ol': true,
                'ul': true,
                'undo': true,
                'redo': true,
                'l_align': true,
                'r_align': true,
                'c_align': true,
                'justify': true,
                // 'insert_link': true,
                // 'unlink': true,
                'insert_img': true,
                // 'hr_line': true,
                // 'block_quote': true,
                'source': true,
                // 'strikeout': true,
                // 'indent': true,
                // 'outdent': true,
                'fonts': fonts,
                'styles': styles,
                'print': true,
                'rm_format': true,
                'status_bar': true,
                'font_size': fontsizes,
                'color': colors,
                'splchars': specialchars,
                'insert_table': true,
                'select_all': true,
                'togglescreen': true
            }, options);

            $('#editorcontent').width(editorwidth);

            var containerDiv = $("<div/>", {class: "row-fluid Editor-container"});
            var $this = $(this).hide();
            $this.after(containerDiv);

            var menuBar = $("<div/>", {
                id: "menuBarDiv",
                class: "row-fluid mainmenu navbar navbar-default navbar-fixed-top container"
            }).prependTo(containerDiv);
            // var editor  = $( "<div/>",{	class : "Editor-editor",
            // 						css : {overflow: "auto"},
            // 						contenteditable:"true",
            // 						// background-image : imageurl
            // 		 	}).appendTo(containerDiv);
            console.log(editor_count);
            var editor = $('<div id = "editor'+editor_count+'" class="Editor-editor" contenteditable="true" style="text-align: left;background-image: url(' + imageurl + ');  padding-top:96px; padding-left:120px; padding-right:120px; padding-bottom:96px;height:' + editorheight + 'px;"></div>').appendTo(containerDiv);
            var statusBar = $("<div/>", {
                id: "statusbar",
                class: "row-fluid",
                unselectable: "on",
            }).appendTo(containerDiv);
            $(this).data("menuBar", menuBar);
            $(this).data("editor", editor);
            $(this).data("statusBar", statusBar);
            var editor_Content = this;
            if (settings['status_bar']) {
                editor.keydown(function (event) {
                    var wordCount = methods.getWordCount.apply(editor_Content);
                    var charCount = methods.getCharCount.apply(editor_Content);

                    if (charCount > 1000){
                        $.alert({
                            title: 'Sorry!',
                            type: 'blue',
                            draggable: true,
                            dragWindowBorder: false,
                            animationBounce: 2.5, // default is 1.2 whereas 1 is no bounce.
                            animationSpeed: 500, // 2 seconds
                            theme: 'material',
                            content: 'We limit letter characters at 1500.',
                        });
                        return;
                    }else{
                        $(editor_Content).data("statusBar").html('<div class="label">' + 'Words : ' + wordCount + '</div>');
                        $(editor_Content).data("statusBar").append('<div class="label">' + 'Characters : ' + charCount + '</div>');
                    }
                });
            }


            for (var item in menuItems) {
                if (!settings[item]) { //if the display is not set to true for the button in the settings.
                    if (settings[item] in menuGroups) {
                        for (var each in menuGroups[item]) {
                            settings[each] = false;
                        }
                    }
                    continue;
                }
                if (item in menuGroups) {
                    var group = $("<div/>", {class: "btn-group"});
                    for (var index = 0; index < menuGroups[item].length; index++) {
                        var value = menuGroups[item][index];
                        if (settings[value]) {
                            var menuItem = methods.createMenuItem.apply(this, [menuItems[value], settings[value], true]);
                            group.append(menuItem);
                        }
                        settings[value] = false;
                    }
                    menuBar.append(group);
                }
                else {
                    var menuItem = methods.createMenuItem.apply(this, [menuItems[item], settings[item], true]);
                    menuBar.append(menuItem);
                }
            }

            //For contextmenu
            $(document.body).mousedown(function (event) {
                var target = $(event.target);
                if (!target.parents().andSelf().is('#context-menu')) { // Clicked outside
                    $('#context-menu').remove();
                }
                if (!target.parents().andSelf().is('#specialchar') && (target.closest('a').html() != '<i class="fa fa-asterisk"></i>')) { //Clicked outside
                    if ($("#specialchar").is(':visible')) {
                        $(editor_Content).data("editor").data("splcharsBtn", null);
                        $('#specialchar').remove();
                    }
                }
                if (!target.parents().andSelf().is('#paletteCntr') && (target.closest('a').html() != '<i class="fa fa-font"></i>')) { //Clicked outside
                    if ($("#paletteCntr").is(':visible')) {
                        $(editor_Content).data("editor").data("colorBtn", null);
                        $('#paletteCntr').remove();
                    }
                }
            });
            editor.bind("contextmenu", function (e) {
                if ($('#context-menu').length)
                    $('#context-menu').remove();
                var cMenu = $('<div/>', {
                    id: "context-menu"
                }).css({
                    position: "absolute", top: e.pageY, left: e.pageX, "z-index": 9999
                }).click(function (event) {
                    event.stopPropagation();
                });
                var cMenuUl = $('<ul/>', {class: "dropdown-menu on", "role": "menu"});
                e.preventDefault();
                if ($(e.target).is('a')) {
                    methods.createLinkContext.apply(this, [e, cMenuUl]);
                    cMenuUl.appendTo(cMenu);
                    cMenu.appendTo('body');
                }
                else if ($(e.target).is('td') || $(e.target).is("th")) {
                    methods.createTableContext.apply(this, [e, cMenuUl]);
                    cMenuUl.appendTo(cMenu);
                    cMenu.appendTo('body');
                }
                else if ($(e.target).is('img')) {

                    methods.createImageContext.apply(this, [e, cMenuUl]);
                    cMenuUl.appendTo(cMenu);
                    cMenu.appendTo('body');
                }
            });
        },
        createLinkContext: function (event, cMenuUl) {
            var cMenuli = $('<li/>').append($('<a/>', {
                id: "rem_link",
                "href": "javascript:void(0)",
                "text": "RemoveLink"
            }).click(function (e) {
                return function () {
                    $(e.target).contents().unwrap();
                    $('#context-menu').remove();
                }
            }(event)));
            cMenuli.appendTo(cMenuUl);

        },

        createImageContext: function (event, cMenuUl) {
            var cModalId = "imgAttribute";
            var cModalHeader = "Image Attributes";
            var imgModalBody = methods.imageAttributeWidget.apply(this, ["edit"]);
            var onSave = function () {
                var urlPattern = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
                var imageAlt = $('#imgAlt').val();
                var imageTarget = $('#imgTarget').val();
                if (imageAlt == "") {
                    methods.showMessage.apply(this, ["imageErrMsg", "Please enter image alternative text"]);
                    return false;
                }
                if (imageTarget != "" && !imageTarget.match(urlPattern)) {
                    methods.showMessage.apply(this, ["imageErrMsg", "Please enter valid url"]);
                    return false;
                }
                if ($("#imgHidden").val() != "") {
                    var imgId = $("#imgHidden").val();
                    $("#" + imgId).attr('alt', imageAlt);
                    if (imageTarget != "") {
                        if ($("#wrap_" + imgId).length)
                            $("#wrap_" + imgId).attr("href", imageTarget);
                        else
                            $("#" + imgId).wrap($('<a/>', {id: "wrap_" + imgId, href: imageTarget, target: "_blank"}));
                    }
                    else {
                        if ($("#wrap_" + imgId).length)
                            $("#" + imgId).unwrap();
                    }
                }
                $("#imgAttribute").modal("hide");
                $(this).data("editor").focus();
            };
            methods.createModal.apply(this, [cModalId, cModalHeader, imgModalBody, onSave]);
            var modalTrigger = $('<a/>', {
                href: "#" + cModalId,
                "text": "Image Attributes",
                "data-toggle": "modal"
            }).click(function (e) {
                return function () {
                    $('#context-menu').remove();
                    var stamp = (new Date).getTime();
                    $('#imgAlt').val($(e.target).closest("img").attr("alt"));
                    $('#imgTarget').val('');

                    if (typeof $(e.target).closest("img").attr("id") !== "undefined") {
                        var identifier = $(e.target).closest("img").attr("id");
                        $('#imgHidden').val(identifier);
                        if ($('#wrap_' + identifier).length)
                            $('#imgTarget').val($('#wrap_' + identifier).attr("href"));
                        else
                            $('#imgTarget').val('');
                    }
                    else {
                        $(e.target).closest("img").attr("id", "img_" + stamp)
                        $('#imgHidden').val("img_" + stamp);
                    }

                }
            }(event));
            cMenuUl.append($('<li/>').append(modalTrigger))
                .append($('<li/>').append($('<a/>', {text: "Remove Image"}).click(
                    function (e) {
                        return function () {
                            $('#context-menu').remove();
                            $(e.target).closest("img").remove();
                        }
                    }(event))));
        },

        createTableContext: function (event, cMenuUl) {
            $('#editProperties').remove();
            var modalId = "editProperties";
            var modalHeader = "Table Properties";
            var tblModalBody = methods.tableWidget.apply(this, ["edit"]);
            var onSave = function () {
                var tblWidthEdt = $('#tblWidthEdt').val();
                var tblHeightEdt = $('#tblHeightEdt').val();
                var tblBorderEdt = $('#tblBorderEdt').val();
                var tblAlignEdt = $('#tblAlignEdt').val();
                var tblCellspacingEdt = $('#tblCellspacingEdt').val();
                var tblCellpaddingEdt = $('#tblCellpaddingEdt').val();
                var tblEdtCssReg = /^auto$|^[+-]?[0-9]+\.?([0-9]+)?(px|em|ex|%|in|cm|mm|pt|pc)?$/ig;
                var tblEdtNumReg = /^[0-9]+\.?([0-9])?$/;
                if (tblWidthEdt != "" && !tblWidthEdt.match(tblEdtCssReg)) {
                    methods.showMessage.apply(this, ["tblErrMsgEdt", "Please enter positive number with or without a valid CSS measurement unit (px,em,ex,%,in,cm,mm,pt,pc)"]);
                    return false;
                }
                if (tblHeightEdt != "" && !tblHeightEdt.match(tblEdtCssReg)) {
                    methods.showMessage.apply(this, ["tblErrMsgEdt", "Please enter positive number with or without a valid CSS measurement unit (px,em,ex,%,in,cm,mm,pt,pc)"]);
                    return false;
                }
                if (tblBorderEdt != "" && !tblBorderEdt.match(tblEdtNumReg)) {
                    methods.showMessage.apply(this, ["tblErrMsgEdt", "Border size must be a positive number"]);
                    return false;
                }
                if (tblCellspacingEdt != "" && !tblCellspacingEdt.match(tblEdtNumReg)) {
                    methods.showMessage.apply(this, ["tblErrMsgEdt", "Cell spacing must be a positive number"]);
                    return false;
                }
                if (tblCellpaddingEdt != "" && !tblCellpaddingEdt.match(tblEdtNumReg)) {
                    methods.showMessage.apply(this, ["tblErrMsgEdt", "Cell padding must be a positive number"]);
                    return false;
                }
                $(event.target).closest('table').css('width', tblWidthEdt);
                if (tblHeightEdt != "")
                    $(event.target).closest('table').css('height', tblHeightEdt);
                $(event.target).closest('table').attr('align', tblAlignEdt);
                $(event.target).closest('table').attr('border', tblBorderEdt);
                $(event.target).closest('table').attr('cellspacing', tblCellspacingEdt);
                $(event.target).closest('table').attr('cellpadding', tblCellpaddingEdt);
                $("#editProperties").modal("hide");
                $(this).data("editor").focus();
            };
            methods.createModal.apply(this, [modalId, modalHeader, tblModalBody, onSave]);
            var modalTrigger = $('<a/>', {
                href: "#" + modalId,
                "text": "Table Properties",
                "data-toggle": "modal"
            }).click(function (e) {
                return function () {
                    $('#context-menu').remove();
                    $('#tblRowsEdt').val($(e.target).closest('table').prop('rows').length);
                    $('#tblColumnsEdt').val($(e.target).closest('table').find('tr')[0].cells.length);
                    $('#tblRowsEdt').attr('disabled', 'disabled');
                    $('#tblColumnsEdt').attr('disabled', 'disabled');
                    $('#tblWidthEdt').val($(e.target).closest('table').get(0).style.width);
                    $('#tblHeightEdt').val($(e.target).closest('table').get(0).style.height);
                    $('#tblAlignEdt').val($(e.target).closest('table').attr("align"));
                    $('#tblBorderEdt').val($(e.target).closest('table').attr("border"));
                    $('#tblCellspacingEdt').val($(e.target).closest('table').attr("cellspacing"));
                    $('#tblCellpaddingEdt').val($(e.target).closest('table').attr("cellpadding"));


                }
            }(event));

            cMenuUl.append($('<li/>', {class: "dropdown-submenu", css: {display: "block"}})
                .append($('<a/>', {"tabindex": "-1", href: "javascript:void(0)", "text": "Row"}))
                .append($('<ul/>', {class: "dropdown-menu"})
                    .append($('<li/>').append($('<a/>', {
                        id: "tbl_addrow",
                        "href": "javascript:void(0)",
                        "text": "Add Row"
                    }).click(function (e) {
                        return function () {
                            $("#context-menu").remove();
                            var selectedRow = $(e.target).closest("tr");
                            var newRow = $("<tr/>");
                            selectedRow.children().each(function () {
                                var newColumn = $("<" + $(this).prop("nodeName") + "/>").html("&nbsp;");
                                newRow.append(newColumn);
                            });
                            selectedRow.after(newRow);
                        }
                    }(event))))
                    .append($('<li/>').append($('<a/>', {text: "Remove Row"}).click(
                        function (e) {
                            return function () {
                                $('#context-menu').remove();
                                $(e.target).closest("tr").remove();
                            }
                        }(event))))
                )).append($('<li/>', {class: "dropdown-submenu", css: {display: "block"}})
                .append($('<a/>', {"tabindex": "-1", href: "javascript:void(0)", "text": "Column"}))
                .append($('<ul/>', {class: "dropdown-menu"})
                    .append($('<li/>').append($('<a/>', {
                        id: "tbl_addcolumn",
                        "href": "javascript:void(0)",
                        "text": "Add Column",
                    }).click(function (e) {
                        return function () {
                            $('#context-menu').remove();
                            var selectedCell = $(e.target);
                            var columnIndex = selectedCell.siblings().addBack().index(selectedCell);
                            selectedCell.closest("table").find("tr").each(function () {
                                var cellInSelectedColumn = $(this).children(":eq(" + columnIndex + ")");
                                var newCell = $("<" + cellInSelectedColumn.prop("nodeName") + "/>").html("&nbsp;");
                                cellInSelectedColumn.after(newCell);
                            });
                        }
                    }(event))))
                    .append($('<li/>').append($('<a/>', {text: "Remove Column"}).click(
                        function (e) {
                            return function () {
                                $('#context-menu').remove();
                                var selectedCell = $(e.target);
                                var columnIndex = selectedCell.siblings().addBack().index(selectedCell);
                                selectedCell.closest("table").find("tr").each(function () {
                                    $(this).children(":eq(" + columnIndex + ")").remove();
                                });
                            }
                        }(event))))
                ));
            cMenuUl.append($('<li/>').append(modalTrigger))
                .append($('<li/>', {class: "divider"}))
                .append($('<li/>').append($('<a/>', {text: "Remove Table"}).click(
                    function (e) {
                        return function () {
                            $('#context-menu').remove();
                            $(e.target).closest("table").remove();
                        }
                    }(event))));

        },

        createModal: function (modalId, modalHeader, modalBody, onSave) {
            //Create a Modal for the button.
            var modalTrigger = $('<a/>', {
                href: "#" + modalId,
                role: "button",
                class: "btn btn-default",
                "data-toggle": "modal"
            });
            var modalElement = $('<div/>', {
                id: modalId,
                class: "modal fade",
                tabindex: "-1",
                role: "dialog",
                "aria-labelledby": "h3_" + modalId,
                "aria-hidden": "true"
            }).append($('<div>', {
                    class: "modal-dialog"
                }).append($('<div>', {
                    class: "modal-content"
                }).append($('<div>', {
                    class: "modal-header"
                }).append($('<button/>', {
                    type: "button",
                    class: "close",
                    "data-dismiss": "modal",
                    "aria-hidden": "true"
                }).html('x')
                ).append($('<h3/>', {
                    id: "h3_" + modalId
                }).html(modalHeader))
                ).append($('<div>', {
                    class: "modal-body"
                }).append(modalBody)
                ).append($('<div>', {
                    class: "modal-footer"
                }).append($('<button/>', {
                    type: "button",
                    class: "btn btn-default",
                    "data-dismiss": "modal",
                    "aria-hidden": "true"
                }).html('Cancel')
                ).append($('<button/>', {
                    type: "button",
                    class: "btn btn-success",
                }).html('Done').mousedown(function (e) {
                    e.preventDefault();
                }).click(function (obj) {
                    return function () {
                        onSave.apply(obj)
                    }
                }(this)))
                )
                )
            );
            modalElement.appendTo("body");
            return modalTrigger;
        },

        createMenuItem: function (itemSettings, options, returnElement) {
            //Function to perform multiple actions.supplied arguments: itemsettings-list of buttons and button options, options: options for select input, returnelement: boolean.
            //1.Create Select Options using Bootstrap Dropdown.
            //2.Create modal dialog using bootstrap options
            //3.Create menubar buttons binded with corresponding event actions
            typeof returnElement !== 'undefined' ? returnElement : false;

            if (itemSettings["select"]) {
                var menuWrapElement = $("<div/>", {class: "btn-group"});
                var menuElement = $("<ul/>", {class: "dropdown-menu"});
                menuWrapElement.append($('<a/>', {
                    class: "btn btn-default dropdown-toggle",
                    "data-toggle": "dropdown",
                    "href": "javascript:void(0)",
                    "title": itemSettings["tooltip"]
                }).html(itemSettings["default"]).append($("<span/>", {class: "caret"})).mousedown(function (e) {
                    e.preventDefault();
                }));
                $.each(options, function (i, v) {
                    var option = $('<li/>')
                    $("<a/>", {
                        tabindex: "-1",
                        href: "javascript:void(0)"
                    }).html(i).appendTo(option);

                    option.click(function () {
                        $(this).parent().parent().data("value", v);
                        $(this).parent().parent().trigger("change")
                    });
                    menuElement.append(option);
                });
                var action = "change";
            }
            else if (itemSettings["modal"]) {
                var menuWrapElement = methods.createModal.apply(this, [itemSettings["modalId"], itemSettings["modalHeader"], itemSettings["modalBody"], itemSettings["onSave"]]);
                var menuElement = $("<i/>");
                if (itemSettings["icon"])
                    menuElement.addClass(itemSettings["icon"]);
                else
                    menuElement.html(itemSettings["text"]);
                menuWrapElement.append(menuElement);
                menuWrapElement.mousedown(function (obj, methods, beforeLoad) {
                    return function (e) {
                        e.preventDefault();
                        methods.saveSelection.apply(obj);
                        if (beforeLoad) {
                            beforeLoad.apply(obj);
                        }
                    }
                }(this, methods, itemSettings["beforeLoad"]));
                menuWrapElement.attr('title', itemSettings['tooltip']);
                return menuWrapElement;
            }
            else {
                var menuWrapElement = $("<a/>", {href: 'javascript:void(0)', class: 'btn btn-default'});
                var menuElement = $("<i/>");
                if (itemSettings["icon"])
                    menuElement.addClass(itemSettings["icon"]);
                else
                    menuElement.html(itemSettings["text"]);
                var action = "click";
            }
            if (itemSettings["custom"]) {
                menuWrapElement.bind(action, (function (obj, params) {
                    return function () {
                        methods.saveSelection.apply(obj);
                        itemSettings["custom"].apply(obj, [$(this), params]);
                    }
                })(this, itemSettings['params']));
            }
            else {
                menuWrapElement.data("commandName", itemSettings["commandname"]);
                menuWrapElement.data("editor", $(this).data("editor"));
                menuWrapElement.bind(action, function () {
                    methods.setTextFormat.apply(this)
                });
            }
            menuWrapElement.attr('title', itemSettings['tooltip']);
            menuWrapElement.css('cursor', 'pointer');
            menuWrapElement.append(menuElement);
            if (returnElement)
                return menuWrapElement;
            $(this).data("menuBar").append(menuWrapElement);
        },

        setTextFormat: function () {
            //Function to run the text formatting options using execCommand.
            methods.setStyleWithCSS.apply(this);
            document.execCommand($(this).data("commandName"), false, $(this).data("value") || null);
            $(this).data("editor").focus();
            return false;
        },

        getSource: function (button, params) {
            //Function to show the html source code to the editor and toggle the text display.
            var flag = 0;
            if (button.data('state')) {
                flag = 1;
                button.data('state', null);
            }
            else
                button.data('state', 1);
            $(this).data("source-mode", !flag);
            var editor = $(this).data('editor');
            var content;
            if (flag == 0) { //Convert text to HTML
                content = document.createTextNode(editor.html());
                editor.empty();
                editor.attr('contenteditable', false);
                preElement = $("<pre/>", {
                    contenteditable: true
                });
                preElement.append(content);
                editor.append(preElement);
                button.parent().siblings().hide();
                button.siblings().hide();
            }
            else {
                var html = editor.children().first().text();
                editor.html(html);
                editor.attr('contenteditable', true);
                button.parent().siblings().show();
                button.siblings().show();
            }
        },

        countWords: function (node) {
            //Function to count the number of words recursively as the text grows in the editor.
            var count = 0;
            var textNodes = node.contents().filter(function () {
                return (this.nodeType == 3);
            });
            for (var index = 0; index < textNodes.length; index++) {
                text = textNodes[index].textContent;
                text = text.replace(/[^-\w\s]/gi, ' ');
                text = $.trim(text);
                count = count + text.split(/\s+/).length;
            }
            var childNodes = node.children().each(function () {
                count = count + methods.countWords.apply(this, [$(this)]);
            });
            return count
        },

        countChars: function (node) {
            //Function to count the number of characters recursively as the text grows in the editor.
            var count = 0;
            var textNodes = node.contents().filter(function () {
                return (this.nodeType == 3);
            });
            for (var index = 0; index < textNodes.length; index++) {
                text = textNodes[index].textContent;
                count = count + text.length;
            }
            var childNodes = node.children().each(function () {
                count = count + methods.countChars.apply(this, [$(this)]);
            });
            return count;
        },

        getWordCount: function () {
            //Function to return the word count of the text in the editor
            return methods.countWords.apply(this, [$(this).data("editor")]);
        },

        getCharCount: function () {
            //Function to return the character count of the text in the editor
            return methods.countChars.apply(this, [$(this).data("editor")]);
        },

        rgbToHex: function (rgb) {
            //Function to convert the rgb color codes into hexadecimal code
            rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            return "#" +
                ("0" + parseInt(rgb[1], 10).toString(16)).slice(-2) +
                ("0" + parseInt(rgb[2], 10).toString(16)).slice(-2) +
                ("0" + parseInt(rgb[3], 10).toString(16)).slice(-2);
        },

        showMessage: function (target, message) {
            //Function to show the error message. Supplied arguments:target-div id, message-message text to be displayed.
            var errorDiv = $('<div/>', {class: "alert alert-danger"}
            ).append($('<button/>', {
                type: "button",
                class: "close",
                "data-dismiss": "alert",
                html: "x"
            })).append($('<span/>').html(message));
            errorDiv.appendTo($('#' + target));
            setTimeout(function () {
                $('.alert').alert('close');
            }, 3000);
        },

        getText: function () {
            //Function to get the source code.
            if (!$(this).data("source-mode"))
                return $(this).data("editor").html();
            else
                return $(this).data("editor").children().first().text();
        },

        setText: function (text) {
            //Function to set the source code
            if (!$(this).data("source-mode"))
                $(this).data("editor").html(text);
            else
                $(this).data("editor").children().first().text(text);
        },

        setStyleWithCSS: function () {
            if (navigator.userAgent.match(/MSIE/i)) {	//for IE10
                try {
                    Editor.execCommand("styleWithCSS", 0, false);
                } catch (e) {
                    try {
                        Editor.execCommand("useCSS", 0, true);
                    } catch (e) {
                        try {
                            Editor.execCommand('styleWithCSS', false, false);
                        }
                        catch (e) {
                        }
                    }
                }
            }
            else {
                document.execCommand("styleWithCSS", null, true);
            }
        },

    }

    $.fn.Editor = function (method) {

        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.Editor');
        }
    };
})(jQuery);



