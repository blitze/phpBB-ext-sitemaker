/* global $ */
import CodeMirror from 'codemirror';
import 'codemirror/mode/twig/twig';
import 'codemirror/addon/hint/show-hint';
import 'codemirror/addon/hint/show-hint.css';

import Twig, { twig } from 'twig';
import { initCodeMirror } from '../CodeMirror';

import './style.scss';

const { actions } = window;

Twig.extendFunction('lang', value => value);

const samples = [
	`<a href="{{ item.link }}" target="_blank">{{ item.title }}</a>	`,
	`
{% if item.enclosure.link %}
<a href="{{ item.link }}" target="_blank" class="img-ui">
	<img src="{{ item.enclosure.link }}" alt="{{ lang('IMAGE') }}" />
</a>
{% endif %}
<div class="sm-fill-space small-img">
	<p class="topic-title"><a href="{{ item.link }}" target="_blank">{{ item.title }}</a></p>
	<div class="author">{{ item.date|date("m/d/Y") }}</div>
	<p>{{ item.description }}</p>
	<p class="img-ui">
		<a href="{{ item.feed.link }}" target="_blank">
		{% if item.feed.image_url %}
			<img src="{{ item.feed.image_url }}" alt="{{ item.feed.image_title }}" />
		{% else %}
			{{ item.feed.title }}
		{% endif %}
		</a>
	</p>
</div>
	`,
	`
{% set images = attribute(item, 'get_item_tags', ['', 'image']) %}
<a href="{{ item.link }}" target="_blank">
	<img src="{{ images[0].data }}" />
	{{ item.title }}
</a>
	`,
];

export default function Feeds($dialogDiv) {
	let fields = {};
	let codeMirror = {};
	let tplData = {};
	let $previewBox;
	let $sourceBox;
	let $dataBox;
	let $template;

	function getFeeds() {
		return $('.sm-multi-input-item input')
			.get()
			.map(el => $(el).val());
	}

	function previewFeed(tplString) {
		tplString = `<ul class="sm-list">
{% for item in items %}
	<li>
		${tplString}
	</li>
{% endfor %}
</ul>`;
		const template = twig({ data: tplString });
		const output = template.render(tplData);

		$previewBox.html(output);
		$sourceBox.text(output);
	}

	function getFields() {
		const data = {
			feeds: getFeeds(),
			method: 'get_fields',
			service: 'blitze.sitemaker.block.feeds',
		};

		$.post(actions.handle_custom_action, data).done(resp => {
			tplData = resp.data;
			fields = {
				children: resp.fields,
			};

			previewFeed($template.val());
			$dataBox.html(JSON.stringify(tplData, undefined, 4));
		});
	}

	function getWordMapping(str) {
		const regex = /{%\s+for\s+(.*?)\s+in\s+(.*?)\s+%}/gim;
		const mapping = {
			item: 'items', // since user is only entering template for each item, for item in items
		};

		let m;
		// eslint-disable-next-line no-cond-assign
		while ((m = regex.exec(str)) !== null) {
			// This is necessary to avoid infinite loops with zero-width matches
			if (m.index === regex.lastIndex) {
				regex.lastIndex += 1;
			}

			const [, word, match] = m;
			mapping[word] = match;
		}

		return mapping;
	}

	function translatePath(str, mapping, skipArray = false) {
		const parts = str.split('.');
		const parent = parts.shift();
		if (mapping[parent]) {
			const sub = translatePath(mapping[parent], mapping);
			let path = [sub, ...parts].join('.');
			if (!skipArray) {
				path += '.0';
			}
			return path;
		}
		return [parent, ...parts].join('.');
	}

	function findHint(cm) {
		const cursor = cm.getCursor();
		const line = cm.getLine(cursor.line);
		const contentFromLineUp = cm
			.getValue()
			.split('\n')
			.slice(0, cursor.line + 1)
			.join();
		let start = cursor.ch;
		let end = cursor.ch;

		while (start && /\S/.test(line.charAt(start - 1))) start -= 1;
		while (end < line.length && /\w/.test(line.charAt(end))) end += 1;

		const word = line.slice(start, end).toLowerCase();
		const mapping = getWordMapping(contentFromLineUp);
		const translatedPath = translatePath(word, mapping, true);
		const wordPathAr = translatedPath.split('.');
		const currentWord = wordPathAr.pop();

		const found = wordPathAr.reduce(
			(p, c) => (p.children && p.children[c]) || null,
			fields,
		);

		let list = Object.values(
			found && !Array.isArray(found) ? found.children : fields.children,
		);

		if (list.length && currentWord.length) {
			list = list.filter(item => item.text.indexOf(currentWord) >= 0);
		}

		return {
			list,
			from: CodeMirror.Pos(cursor.line, end - currentWord.length),
			to: CodeMirror.Pos(cursor.line, cursor.ch),
		};
	}

	function completeAfterDot(cm) {
		setTimeout(() => {
			const cursor = cm.getCursor();

			if (cm.getTokenTypeAt(cursor) === 'variable') {
				cm.showHint({
					hint: findHint,
					completeSingle: false,
				});
			}
		}, 100);
		return CodeMirror.Pass;
	}

	function codeMirrorIsInitialized() {
		return $('#sm-feed-template')
			.next()
			.hasClass('CodeMirror');
	}

	$previewBox = $dialogDiv.find('#sm-feeds-preview');
	$sourceBox = $dialogDiv.find('#sm-feeds-preview-source');
	$dataBox = $dialogDiv.find('#sm-feeds-data');
	$template = $dialogDiv.find('#sm-feed-template');

	if (!codeMirrorIsInitialized()) {
		codeMirror = initCodeMirror('#sm-feed-template', {
			mode: { name: 'twig', htmlMode: true },
			actionBtnsSelector: '.sm-feed-template-button',
			extraKeys: {
				"'.'": completeAfterDot,
				'Ctrl-Space': 'autocomplete',
			},
		});

		codeMirror.on('blur', cm => {
			const data = cm.getValue().trim();
			previewFeed(data);
		});
	}

	let sampleKey = 0;
	$dialogDiv.on('click', '#sm-template-samples', e => {
		e.preventDefault();
		const sample = samples[sampleKey].trim();
		sampleKey = sampleKey < samples.length - 1 ? sampleKey + 1 : 0;
		codeMirror.setValue(sample);
		previewFeed(sample);
	});

	$dialogDiv.on('input', '.sm-multi-input-item input', getFields);
	$dialogDiv.on('click', '.sm-multi-input-delete', getFields);

	getFields();
}
