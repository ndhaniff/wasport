import React, { Component } from 'react';
import { Form, Input, DatePicker, Select, Button, Upload, Avatar } from 'antd';
import TextArea from 'antd/lib/input/TextArea';
import moment from 'moment';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

const MySwal = withReactContent(Swal);
const FormItem = Form.Item;
const Option = Select.Option;

class Profile extends React.Component{
  state = {
    confirmDirty: false,
    profileimgPreview: window.profileimg,
    email: window.email,
    name: window.name,
    id: window.user.id,
    email: window.email,
    name: window.name,
    firstname : window.firstname,
    lastname : window.lastname,
    motto : window.motto,
    gender : window.gender,
    phone : window.phone,
    birthday : window.birthday,
    loading : false,
  }

  handleSubmit = (e) => {
    e.preventDefault();
    this.props.form.validateFieldsAndScroll((err, data) => {
      if (!err) {

       let profile = {
        id : window.user.id,
        name : data.displayname,
        firstname : data.firstname,
        lastname : data.lastname,
        motto : data.motto,
        gender : data.gender,
        phone : data.prefix + data.phone,
        birthday : data.birthday.format('MM-DD-YYYY'),
       }

       axios.post('/user/updateProfile',profile).then((res) => {
         if(res.data.success){
           /*alert('Profile updated')
           location.href = location.origin + '/dashboard'*/

          MySwal.fire({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            type: 'success',
            title: 'Profile updated'
          })

        } else {
             alert('something wrong')
         }
       })
      }
    });
  }

  normFile = (e) => {
    console.log('Upload event:', e);
    if (Array.isArray(e)) {
      return e;
    }
    return e && e.fileList;
  }

  handleSelectChange = (value) => {

  }

  getBase64(img, callback) {
    const reader = new FileReader();
    reader.addEventListener('load', () => callback(reader.result));
    reader.readAsDataURL(img);
  }

  handleProfileImg = (img) => {

    let imgdata = new FormData;

    imgdata.append('id', window.user.id)
    imgdata.append('profileimg', img)

    axios.post('/user/uploadImage',imgdata).then((res) => {
        if(res.data.success){
            MySwal.fire({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              type: 'success',
              title: 'Profile image updated'
            })

        } else {
            alert('something wrong')
        }
    })

  }

  handleUploadChange = (info) => {
    let file = info.file;
    let fileObj = info.file.originFileObj;

    if (file.status === 'uploading') {
      this.setState({
        loading: true
      })
    }
    if (file.status === 'done') {
      this.getBase64(info.file.originFileObj, profileimgPreview => this.setState({
        profileimgPreview,
        loading: false,
      }))

      this.handleProfileImg(fileObj);
    }
  }

  render(){
    const theDate = moment(this.state.birthday)

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

    const prefixSelector = getFieldDecorator('prefix', {
      initialValue: '60',
    })(
      <Select style={{ width: 70 }}>
        <Option value="60">+60</Option>
      </Select>
    );

    return(
      <Form onSubmit={this.handleSubmit}>
        <FormItem
          {...formItemLayout}
        >
          {getFieldDecorator('upload', {
            valuePropName: 'file',
            getValueFromEvent: this.normFile,
          })(
            <React.Fragment>
              <Avatar style={{margin : '10px'}} src={this.state.profileimgPreview} icon={this.state.loading ? 'loading' : 'user'} size={80} />
              <Upload name="profileimg" action="/user/upload" onChange={this.handleUploadChange} showUploadList={false} listType="picture">
                <Button>
                   Upload
                </Button>
              </Upload>
            </React.Fragment>
          )}
        </FormItem>
        <FormItem
            {...formItemLayout}
            label={(
              <span>
                Display Name&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('displayname', {
              rules: [{ required: true, message: 'Please input your display name!', whitespace: true }],
              initialValue : this.state.name
            })(
              <Input />
            )}
        </FormItem>
        <FormItem
            {...formItemLayout}
            label={(
              <span>
                First Name&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('firstname', {
              rules: [{ required: true, message: 'Please input your first name!', whitespace: true }],
              initialValue: this.state.firstname != null ? this.state.firstname : ""
            })(
              <Input />
            )}
        </FormItem>
        <FormItem
            {...formItemLayout}
            label={(
              <span>
                Last Name&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('lastname', {
              rules: [{ required: true, message: 'Please input your last name!', whitespace: true }],
              initialValue: this.state.lastname != null ? this.state.lastname : ""
            })(
              <Input />
            )}
        </FormItem>
        <FormItem
            {...formItemLayout}
            label={(
              <span>
                Motto&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('motto', {
              rules: [
                { required: true, message: 'Please input your motto!', whitespace: true },
                { min: 8, message: 'Your motto must be at least 8 character', whitespace: true },
              ],
              initialValue: this.state.motto != null ? this.state.motto : ""
            })(
              <TextArea />
            )}
        </FormItem>
        <FormItem
            {...formItemLayout}
            label="E-mail"
            hasFeedback
          >
            {getFieldDecorator('email', {
              rules: [{
                type: 'email', message: 'The input is not valid E-mail!',
                required: true, message: 'Please input your E-mail!',
              }],
              initialValue : this.state.email
            })(

              <Input disabled={true}/>
            )}
          </FormItem>
          <FormItem
            labelCol = {{
                  xs: { span: 24 },
                  sm: { span: 24 },
                }}
            wrapperCol = {{
                  xs: { span: 24 },
                  sm: { span: 20 },
                }}
            label="Phone Number"
            hasFeedback
          >
            {getFieldDecorator('phone', {
              rules: [
                { message: 'Please input your phone number!' },
                { min: 9, message: 'Phone number must be at least 11 including prefix' },
                { max: 11, message: 'This is not valid phone number' },
              ],
              initialValue: this.state.phone != null ? this.state.phone.substring(2) : ""
            })(
              <Input addonBefore={prefixSelector} style={{ width: '100%' }} />
          )}
          </FormItem>
          <FormItem
          {...formItemLayout}
          label="Gender"
          hasFeedback
        >
          {getFieldDecorator('gender', {
            rules: [{ message: 'Please select your gender!' }],
            initialValue: this.state.gender != null ? this.state.gender : ""
          })(
            <Select
              placeholder="Select your gender"
              onChange={this.handleSelectChange}
            >
              <Option value="male">Male</Option>
              <Option value="female">Female</Option>
            </Select>
          )}
        </FormItem>
        <FormItem
          {...formItemLayout}
          label="Birthday"
          hasFeedback
        >
          {getFieldDecorator('birthday', {
            rules: [{ type: 'object', message: 'Please select date!' }],
            initialValue: theDate.isValid() ? moment(this.state.birthday, "MM-DD-YYYY") : ""
            //initialValue: this.state.birthday != null ?  moment("12-25-1995", "MM-DD-YYYY") : ""
          })(
            <DatePicker />
          )}
        </FormItem>
        <FormItem {...formItemLayoutWithOutLabel}>
          <Button type="primary" htmlType="submit">Update Profile</Button>
        </FormItem>
      </Form>
    )
  }
}

const ProfileForm = Form.create()(Profile);

export default ProfileForm
