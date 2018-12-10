import React, { Component } from 'react';
import { Form, Button, Input } from 'antd';
import moment from 'moment';
import withReactContent from 'sweetalert2-react-content';
import Swal from 'sweetalert2';

const MySwal = withReactContent(Swal);
const FormItem = Form.Item;

class Step5Ms extends Component {
  constructor(props) {
    super(props);

    this.state = {
      MerchantCode: props.getStore().MerchantCode,
      RefNo: props.getStore().RefNo,
      Amount: props.getStore().Amount,
      ProdDesc: props.getStore().ProdDesc,
      UserName: props.getStore().UserName,
      UserEmail: props.getStore().UserEmail,
      UserContact: props.getStore().UserContact,
      Remark: props.getStore().Remark,
      Signature: props.getStore().Signature,
      ResponseURL: props.getStore().ResponseURL,
      BackendURL: props.getStore().BackendURL,
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

  handleSubmit = (e) => {}

  render() {

    return(
        <div>
          Anda akan meneruskan ke halaman bayaran.

          <Form onSubmit={this.handleSubmit} method="post" name="ePayment" action="https://payment.ipay88.com.my/ePayment/entry.asp">
            <Input type="hidden" name="MerchantCode" value={this.state.MerchantCode} />
            <Input type="hidden" name="PaymentId" value="" />
            <Input type="hidden" name="RefNo" value={this.state.RefNo} />
            <Input type="hidden" name="Amount" value={this.state.Amount} />
            <Input type="hidden" name="Currency" value="MYR" />
            <Input type="hidden" name="ProdDesc" value={this.state.ProdDesc} />
            <Input type="hidden" name="UserName" value={this.state.UserName} />
            <Input type="hidden" name="UserEmail" value={this.state.UserEmail} />
            <Input type="hidden" name="UserContact" value={this.state.UserContact} />
            <Input type="hidden" name="Remark" value={this.state.Remark} />
            <Input type="hidden" name="Lang" value="UTF-8" />
            <Input type="hidden" name="SignatureType" value="SHA256" />
            <Input type="hidden" name="Signature" value={this.state.Signature} />
            <Input type="hidden" name="ResponseURL" value={this.state.ResponseURL} />
            <Input type="hidden" name="BackendURL" value={this.state.BackendURL} />
            <Input type="submit" value="Proceed with Payment" name="Submit"/>
          </Form>
        </div>
    )
  }
}

const Step5Form = Form.create()(Step5Ms);

export default Step5Form
