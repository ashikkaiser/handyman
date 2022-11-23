/*
	Plugin	: Bootstrap Alert
	Author	: Michael Janea (www.michaeljanea.com)
	Version	: 1.2
*/

eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('7.m.n(\'6\',{8:[\'d\',\'H\',\'I\',\'J\',\'K\',\'L\',\'M\',\'N\',\'h\',\'o-O\',\'o\',\'P\',\'Q\',\'R\',\'S\',\'d-T\',\'d-h\',\'d-U\',\'V\',\'W\',\'X\',\'Y\',\'p\',\'p-h\',\'Z\',\'10\',\'11\',\'e\',\'12\',\'13\',\'14\',\'15\',\'16\',\'17\',\'18\',\'19\',\'1a\',\'1b\',\'1c\',\'1d\',\'1e\',\'1f\',\'1g\',\'1h\',\'1i\',\'1j\',\'1k\',\'1l\',\'q-1m\',\'q\',\'1n\',\'1o\',\'r\',\'r-1p\',\'1q\',\'1r\',\'1s\',\'1t\',\'1u\',\'1v\',\'1w\',\'1x\',\'1y\',\'1z\',\'1A\',\'1B\'],1C:\'1D,1E\',1F:\'6\',1G:j(5){f s=\'<3 g="2 2-t" 9="2">\'+5.8.6.t+\'</3>\'+\'<3 g="2 2-u" 9="2">\'+5.8.6.u+\'</3>\'+\'<3 g="2 2-v" 9="2">\'+5.8.6.v+\'</3>\'+\'<3 g="2 2-w" 9="2">\'+5.8.6.w+\'</3>\';5.x.n(\'y\',7.1H,{z:5.8.6.1I,1J:\'y\',1K:{1L:1},A:{k:[7.m.1M(\'6\')+\'k/B.k\',5.1N.1O],1P:{9:\'1Q\',\'1R-z\':\'1S 1T\'}},1U:j(A,a){a.1V=1W;a.b.1X(\'1Y\');a.b.1Z(s);20(f i=0;i<4;i++){a.b.$.21(\'2\')[i].22(\'23\',j(){f c=C 7.D.b(\'3\');c.$.E=l.E;c.$.F(\'9\',\'2\');c.$.G=l.G;5.24(c)})}f e=C 7.D.b("3");e.$.F(\'B\',\'25:26; 27:28\');a.b.29(e);7.x.2a(\'2b\',l)}})}});',62,136,'||alert|div||editor|bootstrapAlert|CKEDITOR|lang|role|block|element|newAlert|en|el|var|class|ca||function|css|this|plugins|add|zh|fr|pt|sr|bootstrapAlerts|success|info|warning|danger|ui|BootstrapAlert|label|panel|style|new|dom|className|setAttribute|innerHTML|af|sq|ar|eu|bn|bs|bg|cn|hr|cs|da|nl|au|gb|eo|et|fo|fi|gl|ka|de|gu|he|hi|hu|is|id|it|ja|km|ko|ku|lv|lt|mk|ms|mn|no|nb|fa|pl|br|ro|ru|latn|si|sk|sl|es|sv|tt|th|tr|ug|uk|vi|cy|requires|panelbutton|floatpanel|icons|init|UI_PANELBUTTON|plugin|command|modes|wysiwyg|getPath|config|mj_variables_bootstrap_css_path|attributes|listbox|aria|Bootstrap|Alert|onBlock|autoSize|true|addClass|bootstrapAlertClass|setHtml|for|getElementsByClassName|addEventListener|click|insertElement|width|430px|padding|1px|append|fire|ready'.split('|'),0,{}))

for(var i in CKEDITOR.instances){
	CKEDITOR.instances[i].ui.addButton('BootstrapAlert', {
        command : 'bootstrapAlert',
        icon 	: this.path + 'icons/bootstrapAlert.png',
    });
}