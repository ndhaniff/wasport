import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import ReactQuill from 'react-quill';
import Datetime from 'react-datetime';
import Dropzone from 'react-dropzone'

export default class CreateRaceForm extends Component {

    constructor(props){
        super(props)
        this.state = {
            about : '',
            awards : '',
            title : '',
            price : '',
            RaceDateFrom: '',
            RaceDateTo: '',
            RaceDeadlineFrom: '',
            RaceDeadlineTo: '',
            headerImg : [],
            toggleDrop: true,
        }
        
        /* Quill module */
        this.modules = {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline','strike', 'blockquote'],
                [{'list': 'ordered'}, {'list': 'bullet'}, {'indent': '-1'}, {'indent': '+1'}],
                [{ 'color': [] }, { 'background': [] }],
                ['link', 'image'],
                ['clean']
            ],
        }

        this.handleAboutChange = this.handleAboutChange.bind(this)
        this.handleAwardsChange = this.handleAwardsChange.bind(this)
        this.onDrop = this.onDrop.bind(this)
        this.removePreview = this.removePreview.bind(this)
        this.handleInputChange = this.handleInputChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
        this.handleRaceDatetimeFrom = this.handleRaceDatetimeFrom.bind(this)
        this.handleRaceDatetimeTo = this.handleRaceDatetimeTo.bind(this)
        this.handleRaceDeadlineFrom = this.handleRaceDeadlineFrom.bind(this)
        this.handleRaceDeadlineTo = this.handleRaceDeadlineTo.bind(this)
    }
    
    handleSubmit(e){
        e.preventDefault()

        let {about,awards,title,price,RaceDateFrom,RaceDateTo,RaceDeadlineFrom,RaceDeadlineTo,headerImg} = this.state

        let data = new FormData;

        data.append('about', about)
        data.append('awards', awards)
        data.append('title', title)
        data.append('price', price)
        data.append('RaceDateFrom', RaceDateFrom)
        data.append('RaceDateTo', RaceDateTo)
        data.append('RaceDeadlineFrom', RaceDeadlineFrom)
        data.append('RaceDeadlineTo', RaceDeadlineTo)
        data.append('headerImg', headerImg[0])

        axios.post('/admin/races',data).then((res) => {
            console.log(res);
        })
    }

    handleAboutChange(data){
        this.setState({ about: data })
    }

    handleAwardsChange(data){
        this.setState({ awards: data })
    }

    handleInputChange({target: {value,name}}){     
        this.setState({
            [name] : value
        })
    }

    handleRaceDatetimeFrom(date){
        this.setState({
            RaceDateFrom: date.format("YYYY-MM-DD HH:mm a")
        })
    }

    handleRaceDatetimeTo(date){
        this.setState({
            RaceDateTo: date.format("YYYY-MM-DD HH:mm a")
        })
    }

    handleRaceDeadlineFrom(date){
        this.setState({
            RaceDeadlineFrom: date.format("YYYY-MM-DD HH:mm a")
        })
    }

    handleRaceDeadlineTo(date){
        this.setState({
            RaceDeadlineTo: date.format("YYYY-MM-DD HH:mm:ss a")
        })
    }

    onDrop(acceptedFiles, rejectedFiles) {
        this.setState({headerImg: acceptedFiles,toggleDrop:false})
    }

    removePreview(){
        this.setState({headerImg : [],toggleDrop:true})
    }

    render() {
        if(this.state.headerImg.length != 0){
            var previewImg =  <div className="mb-2 text-center"><button onClick={this.removePreview} className="btn btn-danger float-right">X</button><br/><img height="300px" src={this.state.headerImg[0].preview} alt=""/></div>
        } else {
            var previewImg =  <img src="" alt=""/>
        }

        if(this.state.toggleDrop){
            var dropzone = 
         <Dropzone
            style={{
                "width": "100%",
                "border": "1px dashed",
                "padding": "5%",}}
            accept="image/jpeg, image/png"
            onDrop={this.onDrop}
            multiple={false}
            name="headerimg"
        >
            <div className="text-center">
            <p>Try dropping some files here, or click to select files to upload.</p>
            <p>Only *.jpeg and *.png images will be accepted</p>
            </div>
        </Dropzone>
        } else {
            var dropzone = "" 
        }

        var yesterday = Datetime.moment().subtract( 1, 'day' );
        var dateFrom = (current) => {
            return current.isAfter( yesterday );
        }
        var dateTo = (current) => {
            return current.isAfter( this.state.RaceDateFrom );
        }
        var deadFrom = (current) => {
            return current.isBefore( this.state.RaceDateFrom );
        }

        return (

            <div className="wrapper p-5">
                <div className="row justify-content-center">
                    <div className="col-md-10">
                        <div className="card">
                            <div className="card-header">Create Race</div>

                            <div className="card-body">
                                <form onSubmit={this.handleSubmit}>
                                    <div className="form-group">
                                    {previewImg}
                                    {dropzone}
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="racetitle">Race Title</label>
                                        <input onChange={this.handleInputChange} name="title" className="form-control" type="text" id="racetitle" required/>   
                                    </div>
                                    <div className="form-row">
                                    <div className="col-sm-6">
                                        <div className="form-group">
                                        <label htmlFor="price">Race Datetime</label>
                                        <div className="form-row">
                                            <div className="col-sm-5">
                                            <Datetime isValidDate={ dateFrom } onChange={this.handleRaceDatetimeFrom}/>
                                            <input type="hidden" name="about" value={this.state.RaceDateFrom}/>
                                            </div>
                                            <div className="col-sm-1">
                                            to
                                            </div>
                                            <div className="col-sm-5">
                                            <Datetime isValidDate={ dateFrom } onChange={this.handleRaceDatetimeTo}/>
                                            <input type="hidden" name="about" value={this.state.RaceDateTo}/>
                                            </div>
                                         </div>
                                        </div>
                                    </div>
                                    <div className="col-sm-6">
                                        <div className="form-group">
                                        <label htmlFor="price">Registration Deadline</label>
                                         <div className="form-row">
                                            <div className="col-sm-5">
                                            <Datetime isValidDate={ deadFrom } onChange={this.handleRaceDeadlineFrom}/>
                                            <input type="hidden" name="about" value={this.state.RaceDeadlineFrom}/>
                                            </div>
                                            <div className="col-sm-1">
                                            to
                                            </div>
                                            <div className="col-sm-5">
                                            <Datetime isValidDate={ deadFrom } onChange={this.handleRaceDeadlineTo}/>
                                            <input type="hidden" name="about" value={this.state.RaceDeadlineTo}/>
                                            </div>
                                         </div>
                                        </div>
                                    </div>
                                    <div className="col-sm-4">
                                        <div className="form-group">
                                                <label htmlFor="price">Price</label>
                                                <input onChange={this.handleInputChange} name="price" className="form-control" type="text" id="price" />
                                            </div>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div>
                                        <label htmlFor="about">About</label>
                                        <ReactQuill style={{'height':'350px'}} modules={this.modules} theme="snow"  value={this.state.about} onChange={this.handleAboutChange} />
                                        <input type="hidden" name="about" value={this.state.about}/>
                                        </div>
                                    </div><br/><br/>
                                    <div className="form-group">
                                        <div>
                                        <label htmlFor="about">Awards</label>
                                        <ReactQuill style={{'height':'350px'}} modules={this.modules} theme="snow"  value={this.state.awards} onChange={this.handleAwardsChange} />
                                        <input type="hidden" name="awards" value={this.state.awards}/>
                                        </div>
                                    </div>
                                    <br/><br/>
                                    <button className="btn btn-primary" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if(document.getElementById('createraceform')){
    ReactDOM.render(<CreateRaceForm />, document.getElementById('createraceform'))
}