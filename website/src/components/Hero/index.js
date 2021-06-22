import React from 'react';
import clsx from 'clsx';
import styles from './index.module.css';

export default function Hero({ children }) {
	return (
		<header className={clsx('hero hero--primary', styles.heroBanner)}>
			<div className="container">
                {children}
			</div>
		</header>
	);
}
