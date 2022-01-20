using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Prestanomico
{
    #region Status
    public class Status
    {
        #region Member Variables
        protected unknown _id;
        protected string _nombre;
        protected string _descripcion;
        #endregion
        #region Constructors
        public Status() { }
        public Status(string nombre, string descripcion)
        {
            this._nombre=nombre;
            this._descripcion=descripcion;
        }
        #endregion
        #region Public Properties
        public virtual unknown Id
        {
            get {return _id;}
            set {_id=value;}
        }
        public virtual string Nombre
        {
            get {return _nombre;}
            set {_nombre=value;}
        }
        public virtual string Descripcion
        {
            get {return _descripcion;}
            set {_descripcion=value;}
        }
        #endregion
    }
    #endregion
}