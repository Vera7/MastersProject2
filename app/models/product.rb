class Product < ApplicationRecord
require 'CSV'

  def self.import(file)
    CSV.foreach(file.path, encoding: "bom|utf-8", headers: :first_row) do |row| #replaced headers: true, encoding:'iso-8859-1:utf-8'

     Product.create!(row.to_hash)

     #attempt2 starts here
     #obj = self.new
      #obj.attributes.each_key do |attribute|
       # index = row.headers.index(attribute)
        #obj.send("#{attribute}=",row[index]) if index
      #end
      #obj.save
      #attempt 2 ends here


      #product_hash = row.to_hash # exclude the price field
      #product = Product.where(id: product_hash["id"])

      #if product.count == 1
       # product.first.update_attributes(product_hash)
      #else
       # Product.create!(product_hash)
      #end # end if !product.nil?
    end # end CSV.foreach
  end # end self.import(file)
end # end class
