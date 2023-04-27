<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<div className="row border justify-content-center" >
     
     <h5 className= 'text-center' >TASK FROM</h5>
     
     <form>
     <div className="form-group"  >
     <label htmlFor="task">Task</label>
     <input type="text" className="form-control" id="task" name='task' value={task}  />
     </div>
     <br/>
     <div className="form-group">
     <label htmlFor="task_date">Date</label>
     <input type="date"  className="form-control" id="task_date" name='task_date' value={this.getFullDate(task_date)}/>
     </div>
     <br/>
     <div className="form-group">
     <label htmlFor="note">Note</label>
     <textarea className="form-control" id="note"  type="text"  name= "note"  value={note}  ></textarea>
     </div> 
     <br/>
     {(this.props.action ==='add' || this.props.action ==='edit'?( <button type="button" onClick={this.handleSubmit} className="btn btn-outline-primary"  > Save</button>):"")}
     </form>
     </div>
  </div>



</body>
</html>