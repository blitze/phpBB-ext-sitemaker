/* global $ */
import CodeMirror from 'codemirror';
import 'codemirror/mode/htmlmixed/htmlmixed';
import 'codemirror/addon/display/autorefresh';
import 'codemirror/addon/display/fullscreen';
import 'codemirror/lib/codemirror.css';
import 'codemirror/theme/monokai.css';
import 'codemirror/addon/display/fullscreen.css';

import './style.scss';

const { config } = window;

function runAction(cm, action) {
	if (action === 'undo') {
		cm.undo();
	} else if (action === 'redo') {
		cm.redo();
	} else if (action === 'clear') {
		cm.setValue('');
	} else if (action === 'fullscreen') {
		cm.setOption('fullScreen', !cm.getOption('fullScreen'));
		cm.focus();
	}
}

export function insertText(cm, text, newLine = false) {
	if (!cm.getSelection().length) {
		const doc = cm.getDoc();
		const cursor = doc.getCursor();
		const { line } = cursor;
		const lineStr = doc.getLine(line);

		let { ch } = cursor;
		let preCh = '';
		let postCh = '';

		if (newLine && lineStr.length) {
			ch = lineStr.length - 1;
			preCh = '\n';
		} else {
			const chPre = cm.getRange({ line, ch: ch - 1 }, cursor);
			const chPost = cm.getRange(cursor, { line, ch: ch + 1 });

			if (chPre && chPre !== ' ') {
				preCh = ' ';
			}

			if (chPost && chPost !== ' ') {
				postCh = ' ';
			}
		}

		const pos = { ch, line };
		doc.replaceRange(`${preCh}${text.trim()}${postCh}`, pos);
	} else {
		cm.replaceSelection(text.trim());
	}
}

export function initCodeMirror(textarea, overwrites = {}) {
	const $textarea = $(textarea);
	const settings = {
		theme: 'monokai',
		mode: 'htmlmixed',
		direction: config.directionality,
		allowFullScreen: true,
		lineWrapping: false,
		autoRefresh: true,
		indentWithTabs: true,
		lineNumbers: true,
		smartIndent: true,
		actionBtnsSelector: false,
		extraKeys: {},

		// overwrites
		...overwrites,
	};

	if (settings.allowFullScreen) {
		settings.extraKeys = {
			...settings.extraKeys,
			F11: cm => {
				cm.setOption('fullScreen', !cm.getOption('fullScreen'));
				cm.focus();
			},
			Esc: cm => {
				if (cm.getOption('fullScreen')) {
					cm.setOption('fullScreen', false);
				}
			},
		};
	}

	const codeMirror = CodeMirror.fromTextArea($textarea.get(0), settings);

	let $undoRedo = {};

	codeMirror.on('keyHandled', (cm, name, e) => {
		if (name === 'Esc') {
			e.stopPropagation();
		}
	});

	codeMirror.on('change', cm => {
		$textarea.text(` ${cm.getValue().trim()} `).trigger('change');

		if ($undoRedo.length) {
			const historySize = codeMirror.getDoc().historySize();
			$undoRedo.each((i, el) => {
				const action = $(el).data('action');
				$(el).prop('disabled', historySize[action] < 1);
			});
		}
	});

	if (settings.actionBtnsSelector) {
		const $buttons = $(settings.actionBtnsSelector)
			.addClass('CodeMirror-button')
			.click(e => {
				e.preventDefault();
				const action = $(e.currentTarget).data('action');
				runAction(codeMirror, action);
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

export default CodeMirror;
