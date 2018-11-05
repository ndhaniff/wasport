import React, { Component } from 'react';
import { Form, Input, DatePicker, Select, Button } from 'antd';
import TextArea from 'antd/lib/input/TextArea';
import moment from 'moment';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

const FormItem = Form.Item;
const Option = Select.Option;
const MySwal = withReactContent(Swal);

class Step1Ms extends Component {
  constructor(props) {
    super(props);

    this.state = {
      firstname: props.getStore().firstname,
      lastname: props.getStore().lastname,
      phone: props.getStore().phone,
      gender: props.getStore().gender,
      birthday: props.getStore().birthday,
      rid: props.getStore().rid,
    };
  }

  componentDidMount() {}

  componentWillUnmount() {}

  jumpToStep(toStep) {
    // We can explicitly move to a step (we -1 as its a zero based index)
    this.props.jumpToStep(toStep); // The StepZilla library injects this jumpToStep utility into each component
  }

  // not required as this component has no forms or user entry
  // isValidated() {}

  handleSelectChange = (value) => { }

  handleSubmit = (e) => {
    e.preventDefault();
    this.props.form.validateFieldsAndScroll((err, data) => {
      if (!err) {
        if(moment().diff(data.birthday.format('MM-DD-YYYY'), 'years') >= 18) {
          this.props.updateStore({
            firstname : data.firstname,
            lastname : data.lastname,
            gender : data.gender,
            phone : data.prefix + data.phone,
            birthday : data.birthday.format('MM-DD-YYYY'),
            savedToCloud: false // use this to notify step4 that some changes took place and prompt the user to save again
          });

          this.jumpToStep(1)

        } else {

          MySwal.fire({
            showConfirmButton: true,
            confirmButtonColor: 'red',
            type: 'error',
            title: 'Error',
            text: 'Anda mesti sekurang-kurangnya 18 tahun untuk daftar'
          })

        }

      }
    });
  }

  render() {
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

    return (
      <Form onSubmit={this.handleSubmit}>
        <FormItem
            {...formItemLayout}
            label={(
              <span>
                Nama Pertama&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('firstname', {
              rules: [{ required: true, message: 'Sila mengisikan nama pertama anda!', whitespace: true }],
              initialValue: this.state.firstname != null ? this.state.firstname : ""
            })(
              <Input />
            )}
        </FormItem>
        <FormItem
            {...formItemLayout}
            label={(
              <span>
                Nama Terakhir&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('lastname', {
              rules: [{ required: true, message: 'Sila mengisikan nama terakhir anda!', whitespace: true }],
              initialValue: this.state.lastname != null ? this.state.lastname : ""
            })(
              <Input />
            )}
        </FormItem>
          <FormItem
            label={(
              <span>
              Nombor Telefon&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('phone', {
              rules: [
                { required: true, message: 'Sila mengisikan nombor telefon anda!' },
                { min: 9, message: 'Nombor telefon mesti sekurang-kurangnya mengandungi 11 digit termasuk awalan' },
                { max: 11, message: 'Sila mengisikan nombor telefon yang sah' },
              ],
              initialValue: this.state.phone != null ? this.state.phone.substring(2) : ""
            })(
              <Input addonBefore={prefixSelector} style={{ width: '100%' }} />
          )}
          </FormItem>
          <FormItem
            labelCol = {{
                xs: { span: 6 },
                sm: { span: 6 },
            }}
            wrapperCol = {{
                xs: { span: 6 },
                sm: { span: 6 },
            }}
            {...formItemLayout}
            label={(
              <span>
                Jantina&nbsp;
              </span>
            )}
            hasFeedback
          >
          {getFieldDecorator('gender', {
            rules: [{ required: true, message: 'Sila memilih jantina anda!' }],
            initialValue: this.state.gender != null ? this.state.gender : ""
          })(
            <Select
              placeholder="Pilih jantina"
              onChange={this.handleSelectChange}
            >
              <Option value="male">Lelaki</Option>
              <Option value="female">Perempuan</Option>
            </Select>
          )}
        </FormItem>


          <FormItem
            {...formItemLayout}
            label={(
              <span>
                Tarikh Lahir&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('birthday', {
              rules: [{ required: true, type: 'object', message: 'Sila memilih tarikh lahir anda!' }],
              initialValue: theDate.isValid() ? moment(this.state.birthday, "MM-DD-YYYY") : ""
            })(
              <DatePicker format="MM-DD-YYYY" />
            )}
          </FormItem>

        <FormItem {...formItemLayoutWithOutLabel}>
          <Button type="primary" onClick={() => window.history.back()} id="register-race-prev">Balik</Button>
          <Button type="primary" htmlType="submit" id="register-race-next" style={{width : '95px'}}>Seterusnya</Button>
        </FormItem>
      </Form>
    )
  }
}

const Step1FormMs = Form.create()(Step1Ms);

export default Step1FormMs
