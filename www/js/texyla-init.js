$.texyla.setDefaults({
	baseDir: '{{$baseUri}}/texyla',
	previewPath: '{{$previewPath}}',
	filesPath: '{{$filesPath}}',
	filesUploadPath: '{{$filesUploadPath}}',
	filesMkDirPath: '{{$filesMkDirPath}}',
	filesRenamePath: '{{$filesRenamePath}}',
	filesDeletePath: '{{$filesDeletePath}}'
});

function texylaInt(){
    $("textarea").texyla({
		toolbar: [
			'h1', 'h2', 'h3', 'h4',
			null,
			'bold', 'italic',
			null,
			'center', ['left', 'right', 'justify'],
			null,
			'ul', 'ol', ["olAlphabetSmall", "olAlphabetBig", "olRomans", "olRomansSmall"],
			null,
			{ type: "label", text: "Vložit"}, 'link', 'img', 'table', 'emoticon', 'symbol',
			null,
			'color', 'textTransform',
			null,
			'div', ['html', 'blockquote', 'text', 'comment'],
			null,
			'code',	['codeHtml', 'codeCss', 'codeJs', 'codePhp', 'codeSql'], 'codeInline',
			null,
			{ type: "label", text: "Ostatní"}, ['sup', 'sub', 'del', 'acronym', 'hr', 'notexy', 'web']

		],
		texyCfg: "admin",
		bottomLeftToolbar: ['edit', 'preview', 'htmlPreview'],
		buttonType: "span",
		tabs: true
	});

	$.texyla({
		buttonType: "button"
	});  
}
