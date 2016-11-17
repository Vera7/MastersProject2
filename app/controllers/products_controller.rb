class ProductsController < ApplicationController
  def index
  	 @products = Product.all
  end

  def import
  	#begin
  		Product.import(params[:file])
    	redirect_to pages_data_url, notice: "Data was successfully imported."
  	#rescue  
     # 	redirect_to root_url, notice: "Invalid CSV file format."
  		
  	#end

    def data
    @prodcuts = Product.all 
  
  end

  end
end
