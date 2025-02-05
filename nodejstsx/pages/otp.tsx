/* eslint-disable @next/next/no-html-link-for-pages */
/* eslint-disable jsx-a11y/label-has-associated-control */
/* eslint-disable @next/next/no-img-element */
import React, { useEffect } from 'react';
import { NextPage } from 'next';
import { useForm } from '@mantine/form';
import { useRouter } from 'next/router';
import { fetchUser } from '../lib/user';

const OTPPage: NextPage = () => {
  const Router = useRouter();

  const CheckUser = async () => {
    const Session = await fetchUser();

    if (Session) {
      if (Session.status !== 'NOTVERIFIED') {
        Router.push('/dashboard');
      } else {
        Router.push('/otp');
      }
    } else {
      Router.push('/login');
    }
  };

  useEffect(() => {
    CheckUser();
  }, []);

  const ResendCode = async () => {
    // fetch request to /api/auth/register/code
    // statusCode: HttpStatus;
    // message?: any;
    // error?: any;
    // data?: T;
    const resendCodeRes = await fetch('/api/auth/register/code');

    const resendCodeData = await resendCodeRes.json();

    // if statusCode is 200, alert success
    if (resendCodeData.statusCode === 200) {
      alert('Code sent successfully');
    } else {
      console.log(resendCodeData);
      alert('Something went wrong');
    }
  };

  const handleSubmit = async (otp: string) => {
    // fetch request to /api/auth/register/verify
    // statusCode: HttpStatus;
    // message?: any;
    // error?: any;
    // data?: T;
    const verifyRes = await fetch('/api/auth/register/verify', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ otp: parseInt(otp, 10) }),
    });

    const verifyData = await verifyRes.json();

    // if statusCode is 200, redirect to /dashboard
    if (verifyData.statusCode === 200) {
      Router.push('/dashboard');
    } else {
      console.log(verifyData);
      alert('Something went wrong');
    }
  };

  const OtpForm = useForm({
    validateInputOnChange: true,

    initialValues: {
      otp: '',
    },
  });

  return (
    <>
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
                <a className="just-cnt-cent align-itm-cent" href="#">
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
            <h1 className="col-12 txt-al-cent">OTP sent at your mail</h1>
            <form
              method="post"
              className="col-12 just-cnt-cent flx-d-col"
              onSubmit={OtpForm.onSubmit((values) => handleSubmit(values.otp))}
            >
              <label>Registered Email</label>
              <input
                type="email"
                name="user_email"
                id=""
                readOnly
                required
                className="col-12"
                placeholder="Your Email"
              />
              <label>Otp *</label>
              <input
                type="password"
                name="otp"
                id=""
                required
                className="col-12"
                placeholder="Your Otp"
                maxLength={6}
                minLength={6}
                {...OtpForm.getInputProps('otp')}
              />
              <p className="error1">
                * Required, Please Fill all the required Fields{' '}
              </p>
              <hr />
              <button type="submit">Verify</button>
              <div className="links col-12 just-cnt-spbw">
                <a href="./index.html">← Go Back</a>
                <button type="button" onClick={() => ResendCode()}>
                  Resend OTP
                </button>
              </div>
              <button type="button">Change Email</button>
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
    </>
  );
};

export default OTPPage;
