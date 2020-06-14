import React from 'react';
import style from './style.module.scss';
import { makeStyles } from '@material-ui/core/styles';
import { Container, TextField, Button } from '@material-ui/core';
import axios, { AxiosResponse } from 'axios';

interface ContactMessage {
  name: string;
  email: string;
  title: string;
  content: string;
}

const useStyles = makeStyles((theme) => ({
  root: {
    '& .MuiTextField-root': {
      margin: theme.spacing(1),
      'min-width': '300px',
      display: 'flex',
      'flex-direction': 'column',
    },
    '& .MuiButtonBase-root': {
      margin: theme.spacing(1),
      display: 'flex',
      'flex-direction': 'column',
    },
  },
}));

const Contact = () => {

  const [isSent, setSent] = React.useState<boolean>(false);

  const [errors, setErrors] = React.useState<ContactMessage>({
    name: '',
    email: '',
    title: '',
    content: ''
  });

  const [state, setState] = React.useState<ContactMessage>({
    name: '',
    email: '',
    title: '',
    content: ''
  });

  const clearForm = () => {
    setState({
      name: '',
      email: '',
      title: '',
      content: ''
    });
  }

  const validate = () => {
    let error = false;
    if (!state.name) {
      error = true;
      setErrors({ ...errors, name: 'Your name must not be empty' })
      console.log(errors);
    }
    if (!state.email) {
      error = true;
      setErrors({ ...errors, email: 'Your email must not be empty' })
      console.log(errors);
    }
    if (!state.title) {
      error = true;
      setErrors({ ...errors, title: 'Title must not be empty' })
      console.log(errors);
    }
    if (!state.content) {
      error = true;
      setErrors({ ...errors, content: 'Message content must not be empty' })
      console.log(errors);
    }
    return error;
  };

  const handleNameChange = (value: string) => {
    setState((prevState) => ({ ...prevState, name: value }));
  };

  const handleEmailChange = (value: string) => {
    setState((prevState) => ({ ...prevState, email: value }));
  };

  const handleTitleChange = (value: string) => {
    setState((prevState) => ({ ...prevState, title: value }));
  };

  const handleContentChange = (value: string) => {
    setState((prevState) => ({ ...prevState, content: value }));
  };

  const clearFormErrors = () => {
    setErrors({
      name: '',
      email: '',
      title: '',
      content: ''
    });
  };

  const handleSave = () => {
    clearFormErrors();
    const failedValidation = validate();
    console.log(errors);
    if (!failedValidation) {
      createContactMessage(state).then((response) => {
        if (response === 'Created') {
          setSent(true);
        }
      });
      clearForm();
    }
  };

  const createContactMessage = (message: ContactMessage) =>
    axios
      .post('http://localhost:8080/api/messages', { message })
      .then((res: AxiosResponse) => res.data);


  return (
    <div className={style.contactFormContainer} id="ContactMe">
      <Container>

        <div className={style.innerFormContainer}>
          <h1 style={{ display: isSent ? 'none' : 'block' }}>
            <i>Contact Me</i>
          </h1>
          <form className={useStyles().root} autoComplete="off" noValidate style={{ display: isSent ? 'none' : 'block' }}>
            <TextField
              id="outlined-basic_name"
              label="Name"
              variant="outlined"
              value={state.name}
              onChange={(e) => handleNameChange(e.target.value)}
              error={!!errors.name}
              helperText={errors.name ? errors.name : ''}
            />
            <TextField
              id="outlined-basic_email"
              label="Email"
              variant="outlined"
              value={state.email}
              onChange={(e) => handleEmailChange(e.target.value)}
              error={!!errors.email}
              helperText={errors.email ? errors.email : ''}
            />
            <TextField
              id="outlined-basic_title"
              label="Title"
              variant="outlined"
              value={state.title}
              onChange={(e) => handleTitleChange(e.target.value)}
              error={!!errors.title}
              helperText={errors.title ? errors.title : ''}
            />
            <TextField
              id="outlined-basic_message"
              label="Message"
              variant="outlined"
              multiline
              rows={6}
              value={state.content}
              onChange={(e) => handleContentChange(e.target.value)}
              error={!!errors.content}
              helperText={errors.content ? errors.content : ''}
            />
            <Button variant="contained" color="primary" onClick={handleSave}><strong>Submit</strong></Button>
          </form>
          <div className={style.thankYou} style={{ display: isSent ? 'flex' : 'none' }}>
            <h1>Thank you for your message</h1>
          </div>
        </div>
      </Container>
    </div>
  );
};

export default Contact;