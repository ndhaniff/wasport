import React from 'react';
import { Form, Input, DatePicker, Select, Button, Upload, Avatar } from 'antd';
import TextArea from 'antd/lib/input/TextArea';
import moment from 'moment';

const FormItem = Form.Item;
const Option = Select.Option;

class Password extends React.Component{
  state = {
    confirmDirty: false,
    id: window.user.id,
    new_password : '',
    confirm_password : ''
  }

  handleSubmit = (e) => {
    e.preventDefault();
    this.props.form.validateFieldsAndScroll((err, data) => {
      if (!err) {
          let pass = {
           id : window.user.id,
           new_password : data.new_password,
           confirm_password : data.confirm_password
          }

          axios.post('/user/updatePassword',pass).then((res) => {
            console.log(pass)
            if(res.data.success){
                location.href = location.origin + '/dashboard'
                alert('Password updated')
            } else {
                alert('Password does not match')
            }
          })
        }
    });
  }

  handleSelectChange = (value) => {

  }

  render(){
    const { getFieldDecorator } = this.props.form;

    const formItemLayout = {
      labelCol: {
        xs: { span: 24 },
        sm: { span: 24 },
      },
      wrapperCol: {
        xs: { span: 24 },
        sm: { span: 24 },
      },
    };

    const formItemLayoutWithOutLabel = {
      wrapperCol: {
        xs: { span: 24, offset: 0 },
        sm: { span: 20, offset: 0 },
      },
    };


    return(
      <Form onSubmit={this.handleSubmit}>

        <FormItem
            {...formItemLayout}
            label={(
              <span>
                New Password&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('new_password', {
              rules: [{ required: true, min: 6, message: 'Your password must be at least 6 characters', whitespace: true }],
              initialValue: ""
            })(
              <Input type="password"/>
            )}
        </FormItem>
        <FormItem
            {...formItemLayout}
            label={(
              <span>
                Confirm Password&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('confirm_password', {
              rules: [{ required: true, min: 6, message: 'Your password must be at least 6 characters', whitespace: true }],
              initialValue: ""
            })(
              <Input type="password"/>
            )}
        </FormItem>
      <FormItem {...formItemLayoutWithOutLabel}>
        <Button type="primary" htmlType="submit">Update Password</Button>
      </FormItem>
    </Form>
    )
  }
}

const PasswordForm = Form.create()(Password);

export default PasswordForm
