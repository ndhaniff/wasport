import React from 'react';
import { Form, Input, DatePicker, Select, Button, Upload, Avatar } from 'antd';
import TextArea from 'antd/lib/input/TextArea';
import moment from 'moment';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

const MySwal = withReactContent(Swal);
const FormItem = Form.Item;
const Option = Select.Option;

class PasswordZh extends React.Component{
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
            //console.log(pass)
            if(res.data.success){
                /*location.href = location.origin + '/dashboard'
                alert('Password updated')*/

                MySwal.fire({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  type: 'success',
                  title: '密码已更新'
                })

                window.setTimeout(function(){
                  location.reload();
                } ,3000);

            } else {
                //alert('Password does not match')

                MySwal.fire({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  type: 'error',
                  title: '密码不匹配'
                })

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
                新的密码&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('new_password', {
              rules: [{ required: true, min: 6, message: '密码须至少6个字!', whitespace: true }],
              initialValue: ""
            })(
              <Input type="password"/>
            )}
        </FormItem>
        <FormItem
            {...formItemLayout}
            label={(
              <span>
                确认密码&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('confirm_password', {
              rules: [{ required: true, min: 6, message: '密码须至少6个字', whitespace: true }],
              initialValue: ""
            })(
              <Input type="password"/>
            )}
        </FormItem>
      <FormItem {...formItemLayoutWithOutLabel}>
        <Button type="primary" htmlType="submit">更新</Button>
      </FormItem>
    </Form>
    )
  }
}

const PasswordFormZh = Form.create()(PasswordZh);

export default PasswordFormZh
