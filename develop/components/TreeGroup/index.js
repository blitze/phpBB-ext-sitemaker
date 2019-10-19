/* global $ */
import '../../entries/publicPath';
import AjaxSetup from '../Ajax/setup';
import AddGroup from './AddGroup';
import EditGroup from './EditGroup';
import DeleteGroup from './DeleteGroup';

import './style.scss';

const { config, lang } = window;

const defaultActions = {
	add: 'add_group',
	edit: 'edit_group',
	remove: 'delete_group',
};

function TreeGroup({ idKey, groupActions = {}, ...options }) {
	const $loader = $('#loader i');
	const $msgBox = $('#ajax-message');
	const $groups = $('#sm-groups').show();
	const $tree = $('#nested-tree');
	let $treeBuilder;

	const showMessage = message => {
		if (message) {
			$msgBox.html(message).fadeIn();
		}
	};

	const init = groupId => {
		AjaxSetup($loader, showMessage, `${idKey}=${groupId}`);

		if (groupId > 0) {
			$tree.show();
			if (!$treeBuilder) {
				$treeBuilder = $tree.treeBuilder({
					...options,
					init: () => $tree.treeBuilder('getItems'),
				});
			} else {
				$tree.treeBuilder('getItems');
			}
		} else {
			$tree.hide();
		}
	};

	let { groupId } = config;
	const $firstTreeGroup = $groups.children('.group-item:first');
	if ($firstTreeGroup.length) {
		groupId = $firstTreeGroup.attr('id').substring(6);
	}

	const actions = { ...defaultActions, ...groupActions };

	import(/* webpackChunkName: "tree/builder" */ '../Tree/builder').then(
		() => {
			init(groupId);
			AddGroup($groups, actions);
			EditGroup(actions);
			DeleteGroup($groups, actions, init);
		},
	);

	$('#groups-loader').hide();
	$('body').on('click', '.group-item', e => {
		e.preventDefault();

		// eslint-disable-next-line no-alert
		if (
			!$treeBuilder ||
			!$tree.treeBuilder('isUnsaved') ||
			window.confirm(lang.unsavedChanges)		// eslint-disable-line no-alert
		) {
			groupId = $(e.currentTarget)
				.addClass('row3 current-group')
				.siblings()
				.removeClass('row3 current-group')
				.end()
				.attr('id')
				.substring(6);
			init(groupId);
		}
	});
}

window.TreeGroup = TreeGroup;

export default TreeGroup;
