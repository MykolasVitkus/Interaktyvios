import React from 'react';
import style from './style.module.scss';
import { Container } from '@material-ui/core';
import { Configuration, Section } from '../../App';

interface Props {
    config: Configuration;
    sections: Section[];
}

const Header: React.FC<Props> = ({ config, sections }) => {
    return (
        <header className={style.appHeader}>
            <Container>
                <div className={style.headerContainer}>
                    <div className={style.pictureContainer}>
                        <div className={style.picture}>
                            {config.imageName ? 
                            <img src={"http://localhost:8080/images/" + config.imageName} alt="profile_image"/> :
                            <span></span>    
                            }
                            
                        </div>
                        <div className={style.nameContainer}>
                            <div className={style.nameText}>
                                <strong>{config.fullName}</strong>
                            </div>
                            <div className={style.subnameText}>
                                <i>{config.headline}</i>
                            </div>
                        </div>
                    </div>

                    <div className={style.navigationContainer}>
                        {sections.map((row) =>
                            <a href={'#' + row.title.replace(/ /g, '')} className={style.navigationText} key={row.title}>{row.title}</a>
                        )}
                        <a href="#ContactMe" className={style.navigationText}>Contact Me</a>
                    </div>
                </div>

                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </Container>
        </header>
    );

};

export default Header;