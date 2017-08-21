/* jshint browser: true */

( function( window, $ )
{
    "use strict";
var tb = '<div class="btn-toolbar" role="toolbar" data-role="editor-toolbar" data-target="#qacmseditor" aria-label="">\
<div class="btn-group">\
		<button type="button" tabindex="-1" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hotkey="alt_d1" title="字体"><i class="fa fa-text-height"></i></button>\
<div class="dropdown-menu">\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="FontName SimSun"><span style="font-family: SimSun;">宋体</span></button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="FontName FangSong_GB2312"><span style="font-family: FangSong_GB2312;">仿宋体</span></button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="FontName SimHei"><span style="font-family: SimHei;">黑体</span></button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="FontName KaiTi_GB2312"><span style="font-family: KaiTi_GB2312;">楷体</span></button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="FontName Microsoft YaHei"><span style="font-family: Microsoft YaHei;">微软雅黑</span></button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="FontName Arial"><span style="font-family: Arial;">Arial</span></button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="FontName Arial Black"><span style="font-family: Arial Black;">Arial Black</span></button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="FontName Comic Sans MS"><span style="font-family: Comic Sans MS;">Comic Sans MS</span></button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="FontName Courier New"><span style="font-family: Courier New;">Courier New</span></button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="FontName System"><span style="font-family: System;">System</span></button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="FontName Times New Roman"><span style="font-family: Times New Roman;">Times New Roman</span></button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="FontName Tahoma"><span style="font-family: Tahoma;">Tahoma</span></button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="FontName Verdana"><span style="font-family: Verdana;">Verdana</span></button>\
</div>\
</div>\
	<div class="btn-group">\
		<button type="button" tabindex="-1" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hotkey="alt_d2" title="字号"><i class="fa fa-text-height"></i></button>\
		<div class="dropdown-menu">\
<button class="dropdown-item fs-Five" type="button" tabindex="-1" data-edit="fontSize 5">大</button>\
<button class="dropdown-item fs-Three" type="button" tabindex="-1" data-edit="fontSize 3">普通</button>\
<button class="dropdown-item fs-One" type="button" tabindex="-1" data-edit="fontSize 1">小</button>\
		</div>\
	</div>\
	<div class="btn-group">\
		<button type="button" tabindex="-1" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hotkey="alt_d3" title="背景颜色"><i class="fa fa-paint-brush"></i></button>\
		<div class="dropdown-menu">\
                        <button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="backColor #00FFFF">蓝色</button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="backColor #00FF00">绿色</button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="backColor #FF7F00">橘黄色</button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="backColor #FF0000">红色</button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="backColor #FFFF00">黄色</button>\
		</div>\
	</div>\
	<div class="btn-group">\
		<button type="button" tabindex="-1" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hotkey="alt_d4" title="字体颜色"><i class="fa fa-font"></i></button>\
		<div class="dropdown-menu">\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="foreColor #000000">黑色</button>\
                        <button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="foreColor #0000FF">蓝色</button>\
                        <button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="foreColor #30AD23">绿色</button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="foreColor #FF7F00">橘黄色</button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="foreColor #FF0000">红色</button>\
<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" data-edit="foreColor #FFFF00">黄色</button>\
		</div>\
	</div>\
	<div class="btn-group">\
		<button type="button" tabindex="-1" class="btn btn-secondary" data-edit="bold" data-hotkey="ctrl_b meta_b" title="粗体 (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></button>\
		<button type="button" tabindex="-1" class="btn btn-secondary" data-edit="italic" data-hotkey="ctrl_i meta_i" title="斜体 (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></button>\
		<button type="button" tabindex="-1" class="btn btn-secondary" data-edit="strikethrough" data-hotkey="ctrl_d meta_d" title="删除线 (Ctrl/Cmd加D)"><i class="fa fa-strikethrough"></i></button>\
		<button type="button" tabindex="-1" class="btn btn-secondary" data-edit="underline" data-hotkey="ctrl_u meta_u" title="下划线 (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></button>\
	</div>\
	<div class="btn-group">\
		<button type="button" tabindex="-1" class="btn btn-secondary" data-edit="insertunorderedlist" title="无序列表"><i class="fa fa-list-ul"></i></button>\
		<button type="button" tabindex="-1" class="btn btn-secondary" data-edit="insertorderedlist" title="有序列表"><i class="fa fa-list-ol"></i></button>\
		<button type="button" tabindex="-1" class="btn btn-secondary" data-edit="indent" title="增加缩进"><i class="fa fa-indent"></i></button>\
		<button type="button" tabindex="-1" class="btn btn-secondary" data-edit="outdent" title="减小缩进"><i class="fa fa-outdent"></i></button>\
	</div>\
	<div class="btn-group">\
		<button type="button" tabindex="-1" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hotkey="alt_d5" title="段落标题"><i class="fa fa-pencil"></i>&nbsp;<b class="caret"></b></button>\
<div class="dropdown-menu">\
		<button class="btn btn-secondary dropdown-item"  type="button" tabindex="-1" data-edit="formatBlock <pre>" title="代码">代码</button>\
		<button class="btn btn-secondary dropdown-item"  type="button" tabindex="-1" data-edit="formatBlock <address>" title="Address (Contact Information)">address</button>\
		<button class="btn btn-secondary dropdown-item"  type="button" tabindex="-1" data-edit="formatBlock <h1>">h1</button>\
		<button class="btn btn-secondary dropdown-item"  type="button" tabindex="-1" data-edit="formatBlock <h2>">h2</button>\
		<button class="btn btn-secondary dropdown-item"  type="button" tabindex="-1" data-edit="formatBlock <h3>">h3</button>\
		<button class="btn btn-secondary dropdown-item"  type="button" tabindex="-1" data-edit="formatBlock <h4>">h4</button>\
		<button class="btn btn-secondary dropdown-item"  type="button" tabindex="-1" data-edit="formatBlock <h5>">h5</button>\
		<button class="btn btn-secondary dropdown-item"  type="button" tabindex="-1" data-edit="formatBlock <h6>">h6</button>\
		<button class="btn btn-secondary dropdown-item"  type="button" tabindex="-1" data-edit="formatBlock <p>" title="段落"><i class="fa fa-paragraph"></i></button>\
		<button class="btn btn-secondary dropdown-item"  type="button" tabindex="-1" data-edit="format-blockquote">block</button>\
</div>\
	</div>\
	<div class="btn-group">\
		<button type="button" tabindex="-1" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hotkey="alt_d6" title="对其"><i class="fa "></i>&nbsp;<b class="caret"></b></button>\
		<div class="dropdown-menu">\
		<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" class="btn btn-secondary" data-edit="justifyleft" title="左对齐 (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></button>\
		<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" class="btn btn-secondary" data-edit="justifycenter" title="居中对齐 (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></button>\
		<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" class="btn btn-secondary" data-edit="justifyright" title="右对齐 (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></button>\
		<button class="btn btn-secondary dropdown-item" type="button" tabindex="-1" class="btn btn-secondary" data-edit="justifyfull" title="两端对齐 (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></button>\
		</div>\
	</div>\
	<div class="btn-group">\
		<button type="button" tabindex="-1" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hotkey="ctrl_k meta_k" title="插入链接 (Ctrl/Cmd+K)"><i class="fa fa-link"></i></button>\
		<div class="dropdown-menu">\
<input id="bswe-linkurl" placeholder="请输入链接地址：" type="text" />\
<input id="bswe-linktext" placeholder="请输入链接文本：" type="text" />\
<div><button class="btn" type="button" data-edit="bswe-createLink">确定</button>\
<button class="btn" type="button" data-edit="bswe-noop">取消</button></div>\
		</div>\
	</div>\
	<div class="btn-group">\
		<button type="button" tabindex="-1" class="btn btn-secondary" data-edit="unlink" title="取消链接"><i class="fa fa-unlink"></i></button>\
	</div>\
	<div class="btn-group">\
		<button type="button" tabindex="-1" class="btn btn-secondary btn-media dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hotkey="ctrl_m" title="插入多媒体 (ctrl加m)"><i class="fa fa-lmedia"></i></button>\
		<div class="dropdown-menu">\
<input id="bswe-mediaurl" placeholder="请输入歌曲地址：" type="text" />\
<div><button class="btn" type="button" data-edit="bswe-createMedia">确定</button>\
<button class="btn" type="button" data-edit="bswe-noop">取消</button></div>\
		</div>\
	</div>\
	<div class="btn-group">\
		<button type="button" tabindex="-1" class="btn btn-secondary" data-edit="SelectAll" data-hotkey="ctrl_a meta_a"title="全选 (Ctrl/Cmd+A)"><i class="fa fa-undo"></i></button>\
		<button type="button" tabindex="-1" class="btn btn-secondary" data-edit="Copy" data-hotkey="ctrl_c meta_c" title="复制 (Ctrl/Cmd+C)"><i class="fa fa-copy"></i></button>\
		<button type="button" tabindex="-1" class="btn btn-secondary" data-edit="Cut" data-hotkey="ctrl_x meta_x" title="剪切 (Ctrl/Cmd+X)"><i class="fa fa-cut"></i></button>\
		<button type="button" tabindex="-1" class="btn btn-secondary" data-edit="Undo" data-hotkey="ctrl_z meta_z" title="撤销 (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></button>\
		<button type="button" tabindex="-1" class="btn btn-secondary" data-edit="Redo" data-hotkey="ctrl_y meta_y" title="重做 (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></button>\
		<button type="button" tabindex="-1" class="btn btn-secondary" data-edit="removeFormat" title="删除文字格式"><i class="glyphicon glyphicon-pencil"></i></button>\
	</div>\
</div>';

    /*
     *  Represenets an editor
     *  @constructor
     *  @param {DOMNode} element - The TEXTAREA element to add the Wysiwyg to.
     *  @param {object} userOptions - The default options selected by the user.
     */
    function Wysiwyg( element, userOptions ) {

        // This calls the $ function, with the element as a parameter and
        // returns the jQuery object wrapper for element. It also assigns the
        // jQuery object wrapper to the property $editor on `this`.
        this.selectedRange = null;
        this.editor = element;
        var editor = element;
        var defaults = {
            hotKeys: {
            //"Ctrl+z": "undo",
            //"Ctrl+j meta+j": "justifyfull"
            },
            toolbarSelector: "[data-role=editor-toolbar]",
            commandRole: "edit",
            activeToolbarClass: "btn-info",
            selectionMarker: "edit-focus-marker",
            selectionColor: "darkgrey",
            dragAndDropImages: true,
            keypressTimeout: 200,
            fileUploadError: function( reason, detail ) { console.log( "File upload error", reason, detail ); }
        };

        var options = $.extend( true, {}, defaults, userOptions );
        var toolbarBtnSelector = "a[data-" + options.commandRole + "],button[data-" + options.commandRole + "],input[type=button][data-" + options.commandRole + "]";
        this.bindHotkeys( editor, options, toolbarBtnSelector );

        if ( options.dragAndDropImages ) {
            this.initFileDrops( editor, options, toolbarBtnSelector );
        }

        this.bindToolbar( editor, $( options.toolbarSelector ), options, toolbarBtnSelector );
var self = this;

        editor.attr({ "contenteditable": true, "tabindex": "0", "title": "内容" })
            .on( "mouseup keyup mouseout", function() {
                self.saveSelection();
                self.updateToolbar( editor, toolbarBtnSelector, options );
            } );

        $( window ).bind( "touchend", function( e ) {
            var isInside = ( editor.is( e.target ) || editor.has( e.target ).length > 0 ),
            currentRange = this.getCurrentRange(),
            clear = currentRange && ( currentRange.startContainer === currentRange.endContainer && currentRange.startOffset === currentRange.endOffset );

            if ( !clear || isInside ) {
                self.saveSelection();
                self.updateToolbar( editor, toolbarBtnSelector, options );
            }
        } );
     }

     Wysiwyg.prototype.readFileIntoDataUrl = function( fileInfo ) {
        var loader = $.Deferred(),
        fReader = new FileReader();

        fReader.onload = function( e ) {
            loader.resolve( e.target.result );
        };

        fReader.onerror = loader.reject;
        fReader.onprogress = loader.notify;
        fReader.readAsDataURL( fileInfo );
        return loader.promise();
     };

     Wysiwyg.prototype.cleanHtml = function( o ) {
        var self = this;
        if ( $( self ).data( "wysiwyg-html-mode" ) === true ) {
            $( self ).html( $( self ).text() );
            $( self ).attr( "contenteditable", true );
            $( self ).data( "wysiwyg-html-mode", false );
        }

        // Strip the images with src="data:image/.." out;
        if ( o === true && $( self ).parent().is( "form" ) ) {
            var gGal = $( self ).html;
            if ( $( gGal ).has( "img" ).length ) {
                var gImages = $( "img", $( gGal ) );
                var gResults = [];
                var gEditor = $( self ).parent();
                $.each( gImages, function( i, v ) {
                    if ( $( v ).attr( "src" ).match( /^data:image\/.*$/ ) ) {
                        gResults.push( gImages[ i ] );
                        $( gEditor ).prepend( "<input value='" + $( v ).attr( "src" ) + "' type='hidden' name='postedimage/" + i + "' />" );
                        $( v ).attr( "src", "postedimage/" + i );
                    }
                } );
            }
        }

        var html = $( self ).html();
        return html && html.replace( /(<br>|\s|<div><br><\/div>|&nbsp;)*$/, "" );
     };

     Wysiwyg.prototype.updateToolbar = function( editor, toolbarBtnSelector, options ) {
/**
        if ( options.activeToolbarClass ) {
            $( options.toolbarSelector ).find( toolbarBtnSelector ).each( function() {
                var self =  $( this );
                var commandArr = self.data( options.commandRole ).split( " " );
                var command = commandArr[ 0 ];

                // If the command has an argument and its value matches this button. == used for string/number comparison
                if ( commandArr.length > 1 && document.queryCommandEnabled( command ) && document.queryCommandValue( command ) === commandArr[ 1 ] ) {
                    self.addClass( options.activeToolbarClass );
                }

                // Else if the command has no arguments and it is active
                else if ( commandArr.length === 1 && document.queryCommandEnabled( command ) && document.queryCommandState( command ) ) {
                    self.addClass( options.activeToolbarClass );
                }

                // Else the command is not active
                else {
                    self.removeClass( options.activeToolbarClass );
                }
            } );
        }
*/
     };

     Wysiwyg.prototype.execCommand = function( commandWithArgs, valueArg, editor, options, toolbarBtnSelector ) {
        var commandArr = commandWithArgs.split( " " ),
            command = commandArr.shift(),
            args = commandArr.join( " " ) + ( valueArg || "" );

        var parts = command.split( "-" );

        if ( parts.length === 1 ) {
            document.execCommand( command, false, args );
        } else if ( parts[ 0 ] === "format" && parts.length === 2 ) {
            document.execCommand( "formatBlock", false, parts[ 1 ] );
        } else if ( parts[ 0 ] === "bswe" && parts.length === 2 ) {
            this[ parts[ 1 ] ] ( args );
        }

        ( editor ).trigger( "change" );
        this.updateToolbar( editor, toolbarBtnSelector, options );
     };

     Wysiwyg.prototype.bindHotkeys = function( editor, options, toolbarBtnSelector ) {
        var self = this;
$( options.toolbarSelector ).find("[data-hotkey]").each(function(){
var btn = $(this);
var hotkeyArr = btn.data('hotkey').split( ' ' );
            hotkeyArr.forEach(function (item, index, input) {
                input[index] = 'keydown.' + item;
            });
            var hotkeyDown = hotkeyArr.join( ' ' ).replace('+', '_');
            var hotkeyUp = hotkeyDown.replace('keydown', 'keyup').replace('+', '_');
            editor.on(hotkeyDown, function( e ) {
                if ( editor.attr( "contenteditable" ) && $( editor ).is( ":visible" ) ) {
                    e.preventDefault();
                    e.stopPropagation();
btn.trigger('click');
                }
            } ).on( hotkeyUp, function( e ) {
                if ( editor.attr( "contenteditable" ) && editor.is( ":visible" ) ) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            } );
});
        $.each( options.hotKeys, function( hotkey, command ) {
            if(!command) return;
            var hotkeyArr = hotkey.split( ' ' );
            hotkeyArr.forEach(function (item, index, input) {
                input[index] = 'keydown.' + item;
            });
            var hotkeyDown = hotkeyArr.join( ' ' ).replace('+', '_');
            var hotkeyUp = hotkeyDown.replace('keydown', 'keyup').replace('+', '_');
            editor.on(hotkeyDown, function( e ) {
                if ( editor.attr( "contenteditable" ) && $( editor ).is( ":visible" ) ) {
                    e.preventDefault();
                    e.stopPropagation();
                    self.execCommand( command, null, editor, options, toolbarBtnSelector );
                }
            } ).on( hotkeyUp, function( e ) {
                if ( editor.attr( "contenteditable" ) && editor.is( ":visible" ) ) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            } );
        } );
editor.on('keydown.ctrl_q', function(e) { alert(self.selectedRange);});
//editor.on('keydown.ctrl_m', function(e) {pasteHtmlAtCaret('<embed src="a.mp3"></embed><audio src="b.mp3" volume="50" autoplay="autoplay"></audio>');});
        editor.keyup( function() { editor.trigger( "change" ); } );
     };
     Wysiwyg.prototype.alert = function(a) {
alert(a);
};
     Wysiwyg.prototype.getCurrentRange = function() {
        var sel, range;
        if ( window.getSelection ) {
            sel = window.getSelection();
            if ( sel.getRangeAt && sel.rangeCount ) {
                range = sel.getRangeAt( 0 );
            }
        } else if ( document.selection ) {
            range = document.selection.createRange();
        }

        return range;
     };

     Wysiwyg.prototype.saveSelection = function() {
        this.selectedRange = this.getCurrentRange();
     };

     Wysiwyg.prototype.restoreSelection = function() {
        var selection;
        if ( window.getSelection || document.createRange ) {
            selection = window.getSelection();
            if ( this.selectedRange ) {
                try {
                    selection.removeAllRanges();
                }
                catch ( ex ) {
                    document.body.createTextRange().select();
                    document.selection.empty();
                }
                selection.addRange( this.selectedRange );
            }
        } else if ( document.selection && this.selectedRange ) {
            this.selectedRange.select();
        }
     };


     Wysiwyg.prototype.pasteHtmlAtCaret = function(html) {
        var sel, range;
        if (window.getSelection) {
            // IE9 and non-IE
            sel = window.getSelection();
            if (sel.getRangeAt && sel.rangeCount) {
                range = sel.getRangeAt(0);
                range.deleteContents();
                // Range.createContextualFragment() would be useful here but is
                // non-standard and not supported in all browsers (IE9, for one)
                var el = document.createElement("div");
                el.innerHTML = html;
                var frag = document.createDocumentFragment(), node, lastNode;
                while ( (node = el.firstChild) ) {
                    lastNode = frag.appendChild(node);
                }
                range.insertNode(frag);
                
                // Preserve the selection
                if (lastNode) {
                    range = range.cloneRange();
                    range.setStartAfter(lastNode);
                    range.collapse(true);
                    sel.removeAllRanges();
                    sel.addRange(range);
                }
            }
        } else if (document.selection && document.selection.type != "Control") {
            // IE < 9

            document.selection.createRange().pasteHTML(html);
        }
      }

     // Adding Toggle HTML based on the work by @jd0000, but cleaned up a little to work in this context.
     Wysiwyg.prototype.toggleHtmlEdit = function( editor ) {
        if ( editor.data( "wysiwyg-html-mode" ) !== true ) {
            var oContent = editor.html();
            var editorPre = $( "<pre />" );
            $( editorPre ).append( document.createTextNode( oContent ) );
            $( editorPre ).attr( "contenteditable", true );
            $( editor ).html( " " );
            $( editor ).append( $( editorPre ) );
            $( editor ).attr( "contenteditable", false );
            $( editor ).data( "wysiwyg-html-mode", true );
            $( editorPre ).focus();
        } else {
            $( editor ).html( $( editor ).text() );
            $( editor ).attr( "contenteditable", true );
            $( editor ).data( "wysiwyg-html-mode", false );
            $( editor ).focus();
        }
     };
     Wysiwyg.prototype.createMedia = function() {
        var self = this;
var el = $('#bswe-mediaurl');
var url = el.val();
el.val('');
self.pasteHtmlAtCaret('<embed autostart="true" width="0" height="0" src="' + url + '" type="application/x-mplayer2"></embed>');
					};
     Wysiwyg.prototype.createLink = function( ) {
        var self = this;
var el = $('#bswe-linkurl');
var url = el.val();
var text = (self.selectedRange != null && self.selectedRange != '') ? self.selectedRange : $('#bswe-linktext').val();
 el.val('');
self.pasteHtmlAtCaret('<a href="' + url + '" target="_blank">' + text + '</a>');
					};
     Wysiwyg.prototype.noop = function() {};
     Wysiwyg.prototype.insertFiles = function( files, options, editor, toolbarBtnSelector ) {
        var self = this;
        editor.focus();
        $.each( files, function( idx, fileInfo ) {
            if ( /^image\//.test( fileInfo.type ) ) {
                $.when( self.readFileIntoDataUrl( fileInfo ) ).done( function( dataUrl ) {
                    self.execCommand( "insertimage", dataUrl, editor, options, toolbarBtnSelector );
                    editor.trigger( "image-inserted" );
                } ).fail( function( e ) {
                    options.fileUploadError( "file-reader", e );
                } );
            } else {
                options.fileUploadError( "unsupported-file-type", fileInfo.type );
            }
        } );
     };

     Wysiwyg.prototype.markSelection = function( input, color, options ) {
        this.restoreSelection(  );
        if ( document.queryCommandSupported( "hiliteColor" ) ) {
            document.execCommand( "hiliteColor", false, color || "transparent" );
        }
        this.saveSelection(  );
        input.data( options.selectionMarker, color );
     };

     Wysiwyg.prototype.bindToolbar = function( editor, toolbar, options, toolbarBtnSelector ) {
        var self = this;
        toolbar.find( toolbarBtnSelector ).click( function() {
            self.restoreSelection(  );
            editor.focus();

            if ( editor.data( options.commandRole ) === "html" ) {
                self.toggleHtmlEdit( editor );
            } else {
                self.execCommand( $( this ).data( options.commandRole ), null, editor, options, toolbarBtnSelector );
            }

            self.saveSelection(  );
        } );

        toolbar.find( "[data-toggle=dropdown]" ).click( this.restoreSelection(  ) );

        toolbar.find( "input[type=text][data-" + options.commandRole + "]" ).on("keydown.return", function() {
if(this.value.trim() == '') {
return false;
}
            self.restoreSelection(  );
            editor.focus();
                self.execCommand( $( this ).data( options.commandRole ), this.value.trim(), editor, options, toolbarBtnSelector );
            self.saveSelection(  );
this.value = '';
        } );

        toolbar.find( "input[type=file][data-" + options.commandRole + "]" ).change( function() {
            self.restoreSelection(  );
            if ( this.type === "file" && this.files && this.files.length > 0 ) {
                self.insertFiles( this.files, options, editor, toolbarBtnSelector );
            }
            self.saveSelection(  );
            this.value = "";
        } );
     };

     Wysiwyg.prototype.initFileDrops = function( editor, options, toolbarBtnSelector ) {
         var self = this;
        editor.on( "dragenter dragover", false ).on( "drop", function( e ) {
            var dataTransfer = e.originalEvent.dataTransfer;
            e.stopPropagation();
            e.preventDefault();
            if ( dataTransfer && dataTransfer.files && dataTransfer.files.length > 0 ) {
                self.insertFiles( dataTransfer.files, options, editor, toolbarBtnSelector );
            }
        } );
     };

     /*
      *  Represenets an editor
      *  @constructor
      *  @param {object} userOptions - The default options selected by the user.
      */

     $.fn.wysiwyg = function( userOptions ) {
        var wysiwyg = new Wysiwyg( this, userOptions );
     };
$.fn.editor = function(userOptions) {
var _this = this;
var id = 'bswe' +$.now();
_this.hide().after(tb + '<div class="bootstrap-wysiwyg" id="' + id + '" style="height: 400px"></div>');
$('#' + id).wysiwyg(userOptions);
$('#' + id).on('change', function() {
_this.val($('#' + id).html());
});
$('#' + id).focus();

return _this;
};

} )( window, window.jQuery );
