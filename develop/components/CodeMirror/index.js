/* global $ */
import CodeMirror from 'codemirror';
import 'codemirror/addon/display/autorefresh';
import 'codemirror/mode/javascript/javascript';
import 'codemirror/lib/codemirror.css';
import 'codemirror/theme/monokai.css';

let codeMirror = {};

export function insertText(data) {
	const doc = codeMirror.getDoc();
	const cursor = doc.getCursor();
	const line = doc.getLine(cursor.line);
	const pos = {
		line: cursor.line,
	};

	if (!line.match(/\S/i)) {
		doc.replaceRange(data, pos);
	} else {
		doc.replaceRange(`\n${data}`, pos);
	}
}

export function initCodeMirror(textarea) {
	codeMirror = CodeMirror.fromTextArea($(textarea).get(0), {
		theme: 'monokai',
		lineWrapping: false,
		autoRefresh: true,
		coverGutterNextToScrollbar: false,
		indentWithTabs: true,
		lineNumbers: true,
		indentUnit: 4,
	});

	let cmTabs = 0;
	codeMirror.on('keyup', cm => {
		const doc = cm.getDoc();
		const line = doc.getLine(cm.getCursor().line);
		const matches = line.match(/\s/gim);
		cmTabs = matches ? matches.length : 0;
	});

	codeMirror.on('change', (cm, change) => {
		const spaces = cmTabs * cm.options.tabSize;
		cm.operation(() => {
			for (
				let line = change.from.line + 1,
					end = CodeMirror.changeEnd(change).line;
				line <= end;
				line += 1
			) {
				cm.indentLine(line, spaces);
			}
		});
	});

	return codeMirror;
}
