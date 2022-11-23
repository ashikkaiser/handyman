/*
	Plugin	: Bootstrap Panel
	Author	: Michael Janea (www.michaeljanea.com)
	Version	: 1.3
*/

eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('d.k.e(\'6\',{l:[\'8\',\'w\',\'x\',\'y\',\'z\',\'A\',\'B\',\'C\',\'f\',\'m-D\',\'m\',\'E\',\'F\',\'G\',\'H\',\'8-I\',\'8-f\',\'8-J\',\'K\',\'L\',\'M\',\'N\',\'n\',\'n-f\',\'O\',\'P\',\'Q\',\'R\',\'S\',\'T\',\'U\',\'V\',\'W\',\'X\',\'Y\',\'Z\',\'10\',\'11\',\'12\',\'13\',\'14\',\'15\',\'16\',\'17\',\'18\',\'19\',\'1a\',\'1b\',\'o-1c\',\'o\',\'1d\',\'1e\',\'p\',\'p-1f\',\'1g\',\'1h\',\'1i\',\'1j\',\'1k\',\'1l\',\'1m\',\'1n\',\'1o\',\'1p\',\'1q\',\'1r\'],1s:\'1t\',1u:\'6\',1v:1w,q:9(g){g.1x.e(\'1y\',{1z:g.l.6.1A,1B:\'<4 5="7">\'+\'<4 5="7-1C"><h 5="7-i"></h></4>\'+\'<4 5="7-1D"></4>\'+\'</4>\',1E:\'4(*)[*];h(*)[*]\',r:\'s\',1F:9(3){1G 3.1H==\'4\'&&3.1I(\'7\')},q:9(){2.j(\'i\',2.3.$.a[0].t.b);2.j(\'u\',2.3.1J(\'5\'));2.j(\'v\',2.3.$.a[1].b)},c:9(){2.3.1K(\'5\',2.c.u);2.3.$.a[0].t.b=2.c.i;2.3.$.a[1].b=2.c.v}});d.r.e(\'s\',d.k.1L(\'6\')+\'1M/6.1N\')}});',62,112,'||this|element|div|class|bootstrapPanel|panel|en|function|childNodes|innerHTML|data|CKEDITOR|add|ca|editor|h3|title|setData|plugins|lang|zh|fr|pt|sr|init|dialog|bootstrapPanelDialog|firstChild|style|content|af|sq|ar|eu|bn|bs|bg|cn|hr|cs|da|nl|au|gb|eo|et|fo|fi|gl|ka|de|el|gu|he|hi|hu|is|id|it|ja|km|ko|ku|lv|lt|mk|ms|mn|no|nb|fa|pl|br|ro|ru|latn|si|sk|sl|es|sv|tt|th|tr|ug|uk|vi|cy|requires|widget|icons|mask|true|widgets|BootstrapPanel|button|plugin|template|heading|body|allowedContent|upcast|return|name|hasClass|getAttribute|setAttribute|getPath|dialogs|js'.split('|'),0,{}))

for(var i in CKEDITOR.instances){
	CKEDITOR.instances[i].ui.addButton('BootstrapPanel', {
        command : 'bootstrapPanel',
        icon 	: this.path + 'icons/bootstrapPanel.png',
    });
}