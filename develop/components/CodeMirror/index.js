/* global $ */
import CodeMirror from 'codemirror';
import 'codemirror/mode/htmlmixed/htmlmixed';
import 'codemirror/addon/display/autorefresh';
import 'codemirror/addon/display/fullscreen';
import 'codemirror/lib/codemirror.css';
import 'codemirror/theme/monokai.css';
import 'codemirror/addon/display/fullscreen.css';

import './style.scss';

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

export function initCodeMirror(textarea, overwrites = {}) {
	const $textarea = $(textarea);
	const $buttons = $('.CodeMirror-button');
	const settings = {
		theme: 'monokai',
		mode: 'htmlmixed',
		lineWrapping: false,
		autoRefresh: true,
		indentWithTabs: true,
		lineNumbers: true,
		indentUnit: 4,
		extraKeys: {
			F11: cm => {
				cm.setOption('fullScreen', !cm.getOption('fullScreen'));
				cm.focus();
			},
			Esc: cm => {
				if (cm.getOption('fullScreen')) {
					cm.setOption('fullScreen', false);
				}
			},
		},

		// overwrites
		...overwrites,
	};

	codeMirror = CodeMirror.fromTextArea($textarea.get(0), settings);

	let cmTabs = 0;
	let $undoRedo = {};

	codeMirror.on('keyup', cm => {
		const doc = cm.getDoc();
		const line = doc.getLine(cm.getCursor().line);
		const matches = line.match(/\s/gim);
		cmTabs = matches ? matches.length : 0;
	});

	codeMirror.on('keyHandled', (cm, name, e) => {
		if (name === 'Esc') {
			e.stopPropagation();
		}
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

		if ($undoRedo.length) {
			const historySize = codeMirror.getDoc().historySize();
			$undoRedo.each((i, el) => {
				const action = $(el).data('action');
				$(el).prop('disabled', historySize[action] < 1);
			});
		}
	});

	codeMirror.on('blur', () => {
		$textarea.val(codeMirror.getValue());
	});

	if ($buttons.length) {
		const doAction = {
			undo: () => codeMirror.undo(),
			redo: () => codeMirror.redo(),
			clear: () => codeMirror.setValue(''),
			fullscreen: () => {
				codeMirror.setOption(
					'fullScreen',
					!codeMirror.getOption('fullScreen'),
				);
				codeMirror.focus();
			},
		};

		$buttons.click(e => {
			e.preventDefault();
			const action = $(e.currentTarget).data('action');
			if (doAction[action]) {
				doAction[action]();
			}
		});

		$undoRedo = $buttons
			.filter((i, el) => {
				const action = $(el).data('action');
				return action === 'undo' || action === 'redo';
			})
			.prop('disabled', true);
	}

	return codeMirror;
}
