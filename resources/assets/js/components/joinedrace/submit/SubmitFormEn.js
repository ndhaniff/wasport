import React, { Component } from 'react';
import { Form, Input, DatePicker, Select, Button, Upload, Avatar, Checkbox, InputNumber } from 'antd';
import TextArea from 'antd/lib/input/TextArea';
import moment from 'moment';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

const MySwal = withReactContent(Swal);
const FormItem = Form.Item;
const Option = Select.Option;

class SubmitFormEn extends React.Component{
  state = {
    formStatus: '',
    confirmDirty: false,
    loading: false,
    btnloading: false,
    allorder: window.allorder,
    allsubmissions: window.allsubmissions,
    race_id: this.props.raceID,
    user_id: window.user.id,
    routeimgPreview: '',
    race_title: '',
    race_hour: '',
    race_minute: '',
    race_second: '',
    distance: '',
    order_id: '',
    category: '',
    routeimg: '',
    strava_distance: '',
    strava_hour: '',
    strava_minute: '',
    strava_second: '',
    strava_activity: '',
    map_polyline: ''
  }

  componentDidMount() {
      this.updateSubmission();
  }

  updateSubmission() {
    for(var i=0; i<allorder.length; i++) {
      if(allorder[i]['rid'] == this.props.raceID) {
        let routeimgPreview = allorder[i]['routeimg']
        let race_title = allorder[i]['title_en']
        let category = allorder[i]['category']
        let order_id = allorder[i]['oid']

        this.setState({
          race_title : race_title,
          category : category,
          order_id : order_id,
          formStatus : 'manual'
        })
      }
    }
  }

  handleSubmit = (e) => {
    e.preventDefault();
    this.props.form.validateFieldsAndScroll((err, data) => {
      if (!err) {

      if(this.checkStrava()) {
        let routedata = new FormData;

        routedata.append('oid', this.state.order_id)
        routedata.append('user_id', this.state.user_id)
        routedata.append('race_id', this.state.race_id)

        if(this.state.formStatus == 'manual') {
          routedata.append('race_hour', data.race_hour)
          routedata.append('race_minute', data.race_minute)
          routedata.append('race_second', data.race_second)
          routedata.append('distance', data.distance)
          routedata.append('routeimg', this.state.routeimg)
        }

        if(this.state.formStatus == 'strava') {
          routedata.append('race_hour', data.strava_hour)
          routedata.append('race_minute', data.strava_minute)
          routedata.append('race_second', data.strava_second)
          routedata.append('distance', data.strava_distance)
          routedata.append('strava_activity', this.state.strava_activity)
          routedata.append('map_polyline', this.state.map_polyline)
        }

        axios.post('/user/updateSubmission',routedata).then((res) => {
          if(res.data.success){

            this.setState({loading: false})

            MySwal.fire({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              type: 'success',
              title: 'Submission uploaded'
            })

            window.setTimeout(function(){
              location.reload();
            } ,3000);

           } else {
              alert('something wrong')
           }
        }) .catch((error) => {
            // Error
            if (error.response) {
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                console.log(error.response.data);
                console.log(error.response.status);
                console.log(error.response.headers);
            } else if (error.request) {
                // The request was made but no response was received
                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                // http.ClientRequest in node.js
                console.log(error.request);
            } else {
                // Something happened in setting up the request that triggered an Error
                console.log('Error', error.message);
            }
            console.log(error.config);
        });
      }

    }
  });
}

  checkStrava() {
    if(this.state.strava_activity != null) {
      for(var i=0; i<allsubmissions.length; i++) {
        if(allsubmissions[i]['strava_activity'] == this.state.strava_activity) {
          MySwal.fire({
            showConfirmButton: false,
            timer: 3000,
            type: 'error',
            title: 'Strava activity has been used before'
          })
          return false;
        }
      }
    }
    return true;
  }

  normFile = (e) => {
    console.log('Upload event:', e);
    if (Array.isArray(e)) {
      return e;
    }
    return e && e.fileList;
  }

  getBase64(img, callback) {
    const reader = new FileReader();
    reader.addEventListener('load', () => callback(reader.result));
    reader.readAsDataURL(img);
  }

  handleRouteImg = (img) => {
    this.setState({
      routeimg: img
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
      this.getBase64(info.file.originFileObj, routeimgPreview => this.setState({
        routeimgPreview,
        loading: false,
      }))

      this.handleRouteImg(fileObj)
    }
  }

  handleFormStatus = (e) => {
    e.preventDefault();

    if(this.state.formStatus == 'strava') {
      this.setState({
        formStatus : 'manual',
        routeimg: '',
        routeimgPreview: '',
        distance: '',
        race_hour: '',
        race_minute: '',
        race_second: '',
        strava_activity: '',
      })
    }

    if(this.state.formStatus == 'manual') {
      this.setState({
        formStatus : 'strava',
        routeimg: '',
        routeimgPreview: '',
        strava_distance: '',
        strava_hour: '',
        strava_minute: '',
        strava_second: '',
        strava_activity: ''
      })

      if(window.strava_token == "") {
        MySwal.fire({
          type: 'warning',
          title: 'Strava access has been revoked',
          text: 'Please connect/reconnect to Strava',
          confirmButtonColor: '#e02e3c'
        })
      }

    let api_url = "/strava/getLatest/";
    axios.post(api_url, {
      access_token : window.strava_token
    }).then((res) => {

        if(res.status == 200){
          let data = res.data.data

          let strava_activity_id = data[0]['id']
          let strava_distance = Math.floor(data[0]['distance'] / 1000)
          let strava_total_time = data[0]['moving_time']

          let strava_pace = strava_total_time / strava_distance;

          //get hour from pace
          let strava_hour = Math.floor(strava_pace / 3600);

          //get min from pace
          let strava_min = Math.floor(strava_pace / 60);

          //get remaining seconds
          let strava_sec = strava_pace % 60;

          //get route image
          let polyline =  data[0]['map']['summary_polyline']
          let map_url = 'https://maps.googleapis.com/maps/api/staticmap?size=640x640&key=AIzaSyD72_ThnAh5eTa7BAlAA-2XhwZ_AKDy_Iw&zoom=16&path=weight:3%7Ccolor:red%7Cenc:' + polyline

          //insert data
          this.setState({
            strava_distance: strava_distance,
            strava_hour: strava_hour,
            strava_minute: strava_min,
            strava_second: strava_sec,
            routeimgPreview: map_url,
            strava_activity: strava_activity_id,
            map_polyline: polyline
          })
        }
      }).catch((error) => {
            // Error
            if (error.response) {
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                console.log(error.response.data);
                console.log(error.response.status);
                console.log(error.response.headers);
            } else if (error.request) {
                // The request was made but no response was received
                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                // http.ClientRequest in node.js
                console.log(error.request);
            } else {
                // Something happened in setting up the request that triggered an Error
                console.log('Error', error.message);
            }
            console.log(error.config);
        });

    }
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
        sm: { span: 24, offset: 0 },
      },
    };

    if(this.state.btnloading) {
      var submitBtn = <Button className="buttonload"> <i className="fa fa-spinner fa-spin"></i>Loading</Button>
    } else {
      var submitBtn = <Button type="primary" htmlType="submit">Submit Race</Button>
    }

    if(this.state.formStatus == 'manual') {
      var displayClick = <a href="#" onClick={this.handleFormStatus} id="strava-form-change">
        Click here to get your latest run from Strava
      </a>

      var displayUpload = <FormItem
      {...formItemLayout}
      >
      {getFieldDecorator('upload', {
        valuePropName: 'file',
        getValueFromEvent: this.normFile,
      })(
        <React.Fragment>
          <Upload name="profileimg" action="/user/upload" onChange={this.handleUploadChange} showUploadList={false} listType="picture">
            Upload Route (Click to replace route) <span className="ant-form-item-required"></span>
            <Avatar id="route-uploader" shape="square" style={{margin : '10px'}} src={this.state.routeimgPreview} icon={this.state.loading ? 'loading' : 'upload'} size={430} />
          </Upload>
        </React.Fragment>
      )}
      </FormItem>

      var displayDistance = <FormItem
          {...formItemLayout}
          label={(
            <span>
              Distance Completed (in km, at least {this.state.category} in a run to count)&nbsp;
            </span>
          )}
          hasFeedback
        >
          {getFieldDecorator('distance', {
            rules: [{
              required: true, message: 'Please input distance',
            }],
            initialValue: ""
          })(
            <InputNumber min={0} max={42} placeholder="eg 1"/>
          )}
      </FormItem>

      var displayHour = <FormItem
          {...formItemLayout}
          label={(
            <span>
              Hour&nbsp;
            </span>
          )}
          hasFeedback
        >
          {getFieldDecorator('race_hour', {
            rules: [{
              required: true, message: 'Please input hour',
            }],
            initialValue: ""
          })(
            <InputNumber min={0} max={10} placeholder="eg 1"/>
          )}
      </FormItem>

      var displayMinute = <FormItem
          {...formItemLayout}
          label={(
            <span>
              Minute&nbsp;
            </span>
          )}
          hasFeedback
        >
          {getFieldDecorator('race_minute', {
            rules: [{
              required: true, message: 'Please input minute',
            }],
            initialValue: ""
          })(
            <InputNumber min={0} max={59} placeholder="eg 15"/>
          )}
      </FormItem>

      var displaySecond = <FormItem
          {...formItemLayout}
          label={(
            <span>
              Second&nbsp;
            </span>
          )}
          hasFeedback
        >
          {getFieldDecorator('race_second', {
            rules: [{
              required: true, message: 'Please input second',
            }],
            initialValue: ""
          })(
            <InputNumber min={0} max={59} placeholder="eg 30"/>
          )}
      </FormItem>
    }

    if(this.state.formStatus == 'strava') {
      var displayClick = <a href="#" onClick={this.handleFormStatus} id="strava-form-change">
        Click here to submit manually
      </a>

      var displayUpload = <FormItem
      {...formItemLayout}
      >
      {getFieldDecorator('upload', {
        valuePropName: 'file',
        getValueFromEvent: this.normFile,
      })(
        <React.Fragment>
          <Upload name="profileimg" action="/user/upload" onChange={this.handleUploadChange} showUploadList={false} listType="picture" disabled>
            Upload Route <span className="ant-form-item-required"></span><br />
            <Avatar id="route-uploader" shape="square" style={{margin : '10px'}} src={this.state.routeimgPreview} icon={this.state.loading ? 'loading' : 'upload'} size={430} />
          </Upload>
        </React.Fragment>
      )}
      </FormItem>

      var displayDistance = <FormItem
          {...formItemLayout}
          label={(
            <span>
              Distance Completed (in km, at least {this.state.category} in a run to count)&nbsp;
            </span>
          )}
          hasFeedback
        >
          {getFieldDecorator('strava_distance', {
            rules: [{
              required: true, message: 'Please input distance',
            }],
            initialValue: this.state.strava_distance != null ? this.state.strava_distance : ""
          })(
            <InputNumber disabled={true}/>
          )}
      </FormItem>

      var displayHour = <FormItem
          {...formItemLayout}
          label={(
            <span>
              Hour&nbsp;
            </span>
          )}
          hasFeedback
        >
          {getFieldDecorator('strava_hour', {
            rules: [{
              required: true, message: 'Please input hour',
            }],
            initialValue: this.state.strava_hour != null ? this.state.strava_hour : ""
          })(
            <InputNumber disabled={true}/>
          )}
      </FormItem>

      var displayMinute = <FormItem
          {...formItemLayout}
          label={(
            <span>
              Minute&nbsp;
            </span>
          )}
          hasFeedback
        >
          {getFieldDecorator('strava_minute', {
            rules: [{
              required: true, message: 'Please input minute',
            }],
            initialValue: this.state.strava_minute != null ? this.state.strava_minute : ""
          })(
            <InputNumber disabled={true}/>
          )}
      </FormItem>

      var displaySecond = <FormItem
          {...formItemLayout}
          label={(
            <span>
              Second&nbsp;
            </span>
          )}
          hasFeedback
        >
          {getFieldDecorator('strava_second', {
            rules: [{
              required: true, message: 'Please input second',
            }],
            initialValue: this.state.strava_second != null ? this.state.strava_second : ""
          })(
            <InputNumber disabled={true}/>
          )}
      </FormItem>
    }

    return(
      <div>

      &ensp; {displayClick} <br /><br />

     <Form onSubmit={this.handleSubmit} id="submission-form">

        <FormItem
            {...formItemLayout}
            label={(
              <span>
                Race&nbsp;
              </span>
            )}
            hasFeedback
          >
            {getFieldDecorator('race_title', {
              rules: [{ required: true, message: 'Please select race', whitespace: true }],
              initialValue : this.state.race_title
            })(
              <Input disabled={true} />
            )}
        </FormItem>

        {displayUpload}

        {displayDistance}

        <div className="row">
          <div className="col-sm-12 col-md-3">
            {displayHour}
          </div>
          <div className="col-sm-12 col-md-3">
            {displayMinute}
          </div>
          <div className="col-sm-12 col-md-3">
            {displaySecond}
          </div>
        </div>

        <FormItem
            {...formItemLayout}
            hasFeedback
          >
            {getFieldDecorator('confirm', {
              rules: [{
                required: true, message: 'Please confirm',
              }],
              initialValue : ""
            })(

              <Checkbox>I declare my submission is truthful</Checkbox>
            )}
          </FormItem>

        <FormItem {...formItemLayoutWithOutLabel}>
          {submitBtn}
        </FormItem>
      </Form>
      </div>
    )
  }
}

const SubmitEn = Form.create()(SubmitFormEn);

export default SubmitEn
