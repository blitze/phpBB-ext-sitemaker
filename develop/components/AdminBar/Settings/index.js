import StartPageManager from './StartPage/startPageManager';
import DefaultLayoutManager from './DefaultLayout/defaultLayoutManager';
import LayoutDuplicator from './CopyLayout/layoutDuplicator';
import DeleteAllBlocksManager from './DeleteAllBlocks/deleteAllBlocksManager';
import HidePositionsManager from './HidePositions/hidePositionsManager';

export default function LayoutSettings(adminBar, hideDropdown) {
	const { positions, showMessage } = adminBar;

	StartPageManager();
	DefaultLayoutManager();
	LayoutDuplicator(positions, hideDropdown);
	DeleteAllBlocksManager(positions);
	HidePositionsManager(positions, showMessage);
}
