/* eslint-disable no-alert */
/* eslint-disable @next/next/no-html-link-for-pages */
/* eslint-disable jsx-a11y/label-has-associated-control */
/* eslint-disable @next/next/no-img-element */
import { useForm } from '@mantine/form';
import { NextPage } from 'next';
import { useRouter } from 'next/router';
import { useEffect } from 'react';
import { fetchUser } from '../lib/user';

const Signup: NextPage = () => {
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

  const HandleSignUp = async (values: any) => {
    // remove confirmPassword from values
    const { confirmPassword, ...rest } = values;

    // fetch request to /api/auth/register
    // statusCode: HttpStatus;
    // message?: any;
    // error?: any;
    // data?: T;
    const registerRes = await fetch('/api/auth/register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(rest),
    });

    const registerData = await registerRes.json();

    // if statusCode is 201, redirect to /otp
    if (registerData.statusCode === 201) {
      Router.push('/otp');
    } else {
      console.log(registerData);
      alert('Something went wrong');
    }
  };

  const SignUpForm = useForm({
    validateInputOnChange: true,

    initialValues: {
      who: 'client',
      email: '',
      password: '',
      firstName: '',
      lastName: '',
      dateOfBirth: '12/12/2012',
      phoneNumber: '',
      state: 'somecity',
      city: 'samesame',
      pincode: '123123',
      confirmPassword: '',
    },

    validate: {
      confirmPassword: (value, values) =>
        value !== values.password ? 'Passwords did not match' : null,
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
            <h1 className="col-12 txt-al-cent">
              Create an account for free with us !
            </h1>
            <form
              method="post"
              className="col-12 just-cnt-cent flx-d-col"
              onSubmit={SignUpForm.onSubmit((values) => HandleSignUp(values))}
            >
              <div className="col-12 just-cnt-cent align-itms-cent">
                <div
                  className="col-6 just-cnt-cent flx-d-col"
                  style={{ margin: '0 10px' }}
                >
                  <label>First Name *</label>
                  <input
                    type="text"
                    name="first_name"
                    id=""
                    required
                    className="col-12"
                    placeholder="First Name"
                    {...SignUpForm.getInputProps('firstName')}
                  />
                </div>
                <div
                  className="col-6 just-cnt-cent flx-d-col"
                  style={{ margin: '0 10px' }}
                >
                  <label>Last Name *</label>
                  <input
                    type="text"
                    name="last_name"
                    id=""
                    required
                    className="col-12"
                    placeholder="Last Name"
                    {...SignUpForm.getInputProps('lastName')}
                  />
                </div>
              </div>
              <div className="col-12 just-cnt-cent align-itms-cent">
                <div
                  className="col-6 just-cnt-cent flx-d-col"
                  style={{ margin: '0 10px' }}
                >
                  <label>Email *</label>
                  <input
                    type="email"
                    name="user_email"
                    id=""
                    required
                    className="col-12"
                    placeholder="Your Email"
                    {...SignUpForm.getInputProps('email')}
                  />
                </div>
                <div
                  className="col-6 just-cnt-cent flx-d-col"
                  style={{ margin: '0 10px' }}
                >
                  <label>Phone Number *</label>
                  <input
                    type="tel"
                    name="phone_no"
                    id=""
                    required
                    className="col-12"
                    placeholder="Phone Number"
                    {...SignUpForm.getInputProps('phoneNumber')}
                  />
                </div>
              </div>
              <div className="col-12 just-cnt-cent align-itms-cent flx-d-col">
                <div
                  className="col-12 just-cnt-cent flx-d-col"
                  style={{ margin: '0 10px' }}
                >
                  <label>Password *</label>
                  <input
                    type="password"
                    name="password"
                    id=""
                    required
                    className="col-12"
                    placeholder="Your Password"
                    {...SignUpForm.getInputProps('password')}
                  />
                </div>
                <div
                  className="col-12 just-cnt-cent flx-d-col"
                  style={{ margin: '0 10px' }}
                >
                  <label>Confirm Password *</label>
                  <input
                    type="password"
                    name="re_pass"
                    id=""
                    required
                    className="col-12"
                    placeholder="Confirrm Password"
                    {...SignUpForm.getInputProps('confirmPassword')}
                  />
                </div>
              </div>
              <p className="error1">
                * Required, Please Fill all the required Fields{' '}
              </p>
              <hr />
              <button type="submit">Sign Up</button>
              <div className="links col-12 just-cnt-spbw">
                <a href="./index.html">← Go Back</a>
                <a href="./login.php">Already a user ? Login Instead</a>
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
    </>
  );
};

export default Signup;
