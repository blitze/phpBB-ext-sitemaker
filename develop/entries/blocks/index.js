// @flow
/* global $ */
import AdminBar from '../../components/AdminBar';
import Positions from '../../components/Positions';
import BlocksManager from '../../components/BlocksManager';

$(document).ready(() => {
	const positions = new Positions();
	const adminBar = new AdminBar(positions);

	adminBar.show();
	BlocksManager(positions);
});
