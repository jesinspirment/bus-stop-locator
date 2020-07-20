import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

export default function Login({ clientId, clientSecret, isLoggedInHandler }) {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');

    function handleLogin() {
        // Simple validation first
        if (!validate()) {
            return;
        }

        // Now call Laravel Passport API to get access token
        const params = {
            grant_type: 'password',
            client_id: clientId,
            client_secret: clientSecret,
            username: username,
            password: password
        };

        axios.post('/oauth/token', params)
          .then(response => {
              if (200 === response.status) {
                  axios.defaults.headers.common = {'Accept': 'application/json', 'Authorization': `Bearer ${response.data.access_token}`}
                  isLoggedInHandler(true);
              }
          })
          .catch(error => {
              alert('Invalid credentials!');
          });
    }

    function validate() {
        if ('' == username.trim() || '' == password.trim()) {
            alert('Both fields are required. Please fill them in.');
            return false;
        }

        return true;
    }

    return (
        <div>
            <form>
                <div className="form-group">
                    <label htmlFor="exampleInputEmail1">Email address</label>
                    <input type="email" className="form-control" id="email" name="email" onChange={e => setUsername(e.target.value)} />
                </div>
                <div className="form-group">
                    <label htmlFor="exampleInputPassword1">Password</label>
                    <input type="password" className="form-control" id="password" name="password" onChange={e => setPassword(e.target.value)} />
                </div>

                <button type="button" className="btn btn-primary" onClick={handleLogin}>Login</button>
            </form>
        </div>
    );
}