import React from 'react';
import style from './style.module.scss';
import { Container } from '@material-ui/core';
import { Link } from '../../App';

interface Props {
  socials: Link[];
}

const Socials: React.FC<Props> = ({ socials }) => {
  return (
    <div className={style.footer}>
      <Container>
        <div className={style.footerContent}>
          <div className={style.linksContent}>
            {socials.map((row) => {
              return (
                <a className={style.linkIcon} href={row.url} key={row.icon}>
                  <i className={"fa fa-" + row.icon} />
                </a>
              );
            })}
          </div>
          <span>{(new Date()).getFullYear()}</span>
        </div>
      </Container>
    </div>
  );

};

export default Socials;