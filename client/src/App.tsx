import React, { useState } from 'react';
import './App.css';
import Header from './containers/header/Header';
import Sections from './containers/sections/Sections';
import axios, { AxiosResponse } from 'axios';
import Contact from './containers/contact/Contact';
import Socials from './containers/socials/Socials';

interface GetConfigurationResponse extends AxiosResponse {
    data: Configuration;
}
interface GetSectionsResponse extends AxiosResponse {
    data: Section[];
}
interface GetLinksResponse extends AxiosResponse {
    data: Link[];
}

export interface Configuration {
    site_title: string;
    fullName: string;
    headline: string;
    personalEmail: string;
    imageName: string;
}

export interface Section {
    title: string;
    content: string;
}

export interface Link {
    icon: string;
    url: string;
}

export interface IState {
    loading: boolean;
}

const initialState: IState = {
    loading: true
};

const initialConfigurationState: Configuration = {
    site_title: '',
    fullName: '',
    headline: '',
    personalEmail: '',
    imageName: ''
};

const initialSectionsState: Section[] = [{
    title: '',
    content: ''
}];

const initialLinksState: Link[] = [{
    icon: '',
    url: ''
}];

const App = () => {
    const [state, setState] = useState<IState>(initialState);
    const [config, setConfig] = useState<Configuration>(initialConfigurationState);
    const [sections, setSections] = useState<Section[]>(initialSectionsState);
    const [links, setLinks] = useState<Link[]>(initialLinksState);

    const getConfiguration = () =>
        axios
            .get('http://localhost:8080/api/configuration')
            .then((res: GetConfigurationResponse) => (res.data)
            );
    const getSections = () =>
        axios
            .get('http://localhost:8080/api/sections')
            .then((res: GetSectionsResponse) => (res.data)
            );
    const getLinks = () =>
        axios
            .get('http://localhost:8080/api/links')
            .then((res: GetLinksResponse) => (res.data)
            );

    React.useEffect(() => {
        Promise.all([getConfiguration().then((result) => {
            setConfig(result);
        }),
        getSections().then((result) => {
            setSections(result);
        }),
        getLinks().then((result) => {
            setLinks(result);
        })]).then(() => {
            setState({
                loading: false
            })
        })
    }, [])
    return (
        <div className="App">
            <div className="loading" style={!state.loading ? { opacity: 0, visibility: "hidden" } : {}}>
                <div className="loader">Loading...</div>
            </div>

            <Header config={config} sections={sections} />
            <Sections sections={sections} />
            <Contact />
            <Socials socials={links} />
        </div>
    );
};

export default App;
