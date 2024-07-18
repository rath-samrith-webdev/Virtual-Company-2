//==================
//use yup
//==================
import * as yup from 'yup'

//login validation
export const loginSchema = yup.object({
  email: yup.string().required('Please input your email!'),

  password: yup
    .string()
    .required('Password is required!')
    .min(9, 'Password must be at least 9 characters!')
})

//signup validation
export const singupSchema = yup.object({
  first_name: yup
    .string()
    .required('Input your first name'),

  last_name: yup
    .string()
    .required('Input your last name'),
  name: yup
    .string()
    .required('Input your name'),
  email: yup
    .string()
    .required('Email is required'),
  password: yup
    .string()
    .required('Input your password')
    .min(9, 'Password must be at least 9 characters!'),
  password_confirmation: yup
    .string()
    .required('Password must be match!')
})
