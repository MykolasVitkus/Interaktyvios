import React from 'react';
import style from './style.module.scss';
import { Container } from '@material-ui/core';
import { Section } from '../../App';

interface Props {
    sections: Section[];
}

const Sections: React.FC<Props> = ({ sections }) => {
    return (
        <div className={style.sections}>
            {sections.map((row, index) =>
                <div id={row.title.replace(/ /g, '')} key={index} className={ index % 2 === 0 ? style.sectionContainer__light : style.sectionContainer__dark}>
                    <Container className={style.innerSectionContainer}>
                        <h1>
                            <i>{row.title}</i>
                        </h1>
                        {row.content}
                    </Container>
                </div>
            )}
        </div>
    );

};

export default Sections;