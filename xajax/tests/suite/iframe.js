try {
	if (undefined == iframe.code) {
		iframe.code = {}
	}
} catch (e) {
	iframe = {}
	iframe.code = {}
} finally {
	parent.iframe = iframe;
}

xajax.call('confirm', { parameters: [2] });

iframe.code.loaded = false;

// simulate a 4 second delay in loading the .js file for the iframe
setTimeout('iframe.code.loaded = true;', 4000);

iframe.code.unload = function() {
	iframe.code = {}
	iframe = {}
	parent.iframe = {}
	xajax.$('outputDIV').innerHTML += '<br />iframe.js being unloaded';
}
