/* eslint-disable @next/next/no-html-link-for-pages */
/* eslint-disable jsx-a11y/label-has-associated-control */
/* eslint-disable @next/next/no-img-element */
import React, { useEffect } from 'react';
import { NextPage } from 'next';
import { useRouter } from 'next/router';
import { useForm } from '@mantine/form';
import { fetchUser } from '../lib/user';

const Login: NextPage = () => {
  const Router = useRouter();

  const CheckUser = async () => {
    const Session = await fetchUser();

    if (Session) {
      if (Session.status !== 'NOTVERIFIED') {
        Router.push('/dashboard');
      } else {
        Router.push('/otp');
      }
    }
  };

  useEffect(() => {
    CheckUser();
  }, []);

  const HandleSignIn = async (values: any) => {
    // fetch request to /api/auth/login
    // statusCode: HttpStatus;
    // message?: any;
    // error?: any;
    // data?: T;
    const loginRes = await fetch('/api/auth/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(values),
    });

    const loginData = await loginRes.json();

    // if statusCode is 200, redirect to /dashboard
    if (loginData.statusCode === 200) {
      console.log(loginData);
      if (loginData.data.status === 'NOTVERIFIED') {
        Router.push('/otp');
      } else {
        Router.push('/dashboard');
      }
    } else {
      console.log(loginData);
      alert('Something went wrong');
    }
  };

  const SignInForm = useForm({
    validateInputOnChange: true,
    initialValues: {
      email: '',
      password: '',
    },
  });

  return (
    <div>
      <header className="col-12 just-cnt-cent align-itm-cent">
        <div className="cont col-12 just-cnt-spbw align-itm-cent">
          <div className="h-logo just-cnt-spbw align-itm-cent">
            <img
              src="./images/h-logo-dark.png"
              alt="Logo"
              className="just-cnt-spbw align-itm-cent col-12"
            />
          </div>
          <nav className="col-6 just-cnt-cent align-itm-cent displ-tab">
            <ul className="col-12 just-cnt-cent align-itm-cent">
              <li className="just-cnt-cent align-itm-cent">
                <a className="just-cnt-cent align-itm-cent" href="https://legaldoji.com/">
                  Home
                </a>
              </li>
              <li className="just-cnt-cent align-itm-cent">
                <a className="just-cnt-cent align-itm-cent" href="#">
                  About-Us
                </a>
              </li>
              <li className="just-cnt-cent align-itm-cent">
                <a className="just-cnt-cent align-itm-cent" href="#">
                  FAQs
                </a>
              </li>
              <li className="just-cnt-cent align-itm-cent">
                <a className="just-cnt-cent align-itm-cent" href="#">
                  Join-Us
                </a>
              </li>
            </ul>
          </nav>
          <div className="h-btns align-itm-cent displ-tab">
            <a href="/login" className="jose">
              Login
            </a>
            <a href="/signup" className="jose">
              Signup
            </a>
          </div>
          <button type="button" className="toggle-side-bar displ-mob">
            <i className="fas fa-bars" />
          </button>
        </div>
      </header>

      <main className="col-12">
        <div className="cont col-12 just-cnt-cent flx-d-col">
          <div className="form col-12 just-cnt-cent align-itm-cent flx-d-col">
            <h1 className="col-12 txt-al-cent">Welcome Back !</h1>
            <form
              method="post"
              className="col-12 just-cnt-cent flx-d-col"
              onSubmit={SignInForm.onSubmit(HandleSignIn)}
            >
              <label>Email *</label>
              <input
                type="email"
                name="user_email"
                id=""
                required
                className="col-12"
                placeholder="Your Email"
                {...SignInForm.getInputProps('email')}
              />
              <label>Password *</label>
              <input
                type="password"
                name="password"
                id=""
                required
                className="col-12"
                placeholder="Your Password"
                {...SignInForm.getInputProps('password')}
              />
              <p className="error1">
                * Required, Please Fill all the required Fields{' '}
              </p>
              <hr />
              <button type="submit">Sign In</button>

              <div className="links col-12 just-cnt-spbw">
                <a href="./index.html">← Go Back</a>
                <a href="./index.html">Forgot Password?</a>
              </div>
              <div className="links col-12 just-cnt-cent">
                <a href="./signup.php">New User ? Click here to Sign Up</a>
              </div>
            </form>
          </div>
        </div>
      </main>
      <footer className="col-12 just-cnt-cent align-itm-cent flx-d-col">
        <div className="cont col-12 just-cnt-cent align-itm-cent flx-wrp">
          <div className="sub-cont col-12 col-md-3 flx-d-col just-cnt-cent align-itm-cent">
            <img src="./images/main-logo.png" alt="" className="col-12" />
          </div>
          <div className="sub-cont col-12 col-md-3 flx-d-col just-cnt-cent align-itm-cent">
            <h3>Quick Links</h3>
            <a href="#">Link →</a>
            <a href="#">Link →</a>
            <a href="#">Link →</a>
            <a href="#">Link →</a>
          </div>
          <div className="sub-cont col-12 col-md-3 flx-d-col just-cnt-cent align-itm-cent">
            <h3>Quick Links</h3>
            <a href="#">Link →</a>
            <a href="#">Link →</a>
            <a href="#">Link →</a>
            <a href="#">Link →</a>
          </div>
          <div className="sub-cont col-12 col-md-3 just-cnt-cent align-itm-cent">
            <a href="#">
              <i className="fab fa-instagram" />
            </a>
            <a href="#">
              <i className="fab fa-facebook-f" />
            </a>
            <a href="#">
              <i className="fab fa-twitter" />
            </a>
            <a href="#">
              <i className="fab fa-telegram" />
            </a>
          </div>
        </div>
        <div className="copyr col-12 just-cnt-cent align-itm-cent txt-al-cent">
          <p className="col-12 txt-al-cent">
            Copyright - LegalDoji &copy; All Rights Reserved, 2022 <br />
            Made and Managed By Web-Fire.com
          </p>
        </div>
      </footer>
    <script src="https://kit.fontawesome.com/c758c8bec9.js" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/gsap/1.19.1/TweenMax.min.js'></script>
    </div>
  );
};

export default Login;
